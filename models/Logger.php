<?php /** @noinspection ALL */


namespace app\models;


use Yii;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\HttpException;

class Logger extends ActiveRecord
{
    private static function createFolderLog($path = 'errors'): string
    {
        $year = date('Y-m');
        $path = Yii::getAlias('@runtime').'/'.$path.'/'.$year;

        if(!is_dir($path)){
            try{
                FileHelper::createDirectory($path);
            }
            catch (\Exception $e){
                $errors = [
                    'message' => $e->getMessage(),
                    'url' => \yii\helpers\Url::current([], true),
                    'table' => self::tableName() ?? '',
                ];
                throw new HttpException(404, Yii::t('app', Json::htmlEncode($errors)));
            }
        }
        return is_dir($path) ? $path.'/'.date('d').'.log': '';
    }

    public static function ExceptionLogger($message, $status = 404, $path = null, $model = null, $write = FILE_APPEND)
    {

        $log_file = $path === null ? self::createFolderLog() : self::createFolderLog($path);

        if(empty($log_file))
        {
            throw new HttpException(404, Yii::t('app', 'Каталог журнала не найден'));
        }

        $controller = Yii::$app->controller->id ? Yii::$app->controller->id : Yii::t('app', 'Controller not found');
        $action     = Yii::$app->controller->action->id ? Yii::$app->controller->action->id : Yii::t('app', 'Action not found');
        $modules    = Yii::$app->controller->module->id ? Yii::$app->controller->module->id : Yii::t('app', 'Modules not found');
        $date       = date('Y-m-d H:i:s');

        if(is_array($message))
        {
            $message = Json::encode($message);
        }

        $errors = [
            'message'      => '{ '.$message.' }',
            'controller' => '{ Controller -  '.$controller.' }',
            'action'     => '{ Action -'.$action.' }',
            'module'     => '{ Module - '.$modules.' }',
            'date'       => '{ Vaqt - '.$date.' }',
        ];

        if($model !== null)
        {
            $errors['model'] = '{ Model - '.$model.' }';
        }

        try {
            file_put_contents($log_file, $errors, $write);
        }
        catch (\Exception $e){
            throw new HttpException(404, $e->getMessage());
        }

    }

}