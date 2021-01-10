<?php /** @noinspection ALL */


namespace app\models;

use app\components\CustomBehaviors\CustomBehaviors;
use app\modules\users\models\Users;
use http\Url;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\HttpException;

class BaseModel extends ActiveRecord
{
    const STATUS_ACTIVE   = 1;
    const STATUS_NOACTIVE = 2;
    const STATUS_SAVED    = 3;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            CustomBehaviors::class,
        ];
    }

    private static function createFolderLog($path = 'errors'){
        $year   = date('Y-m');
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

    public static function Logger($error, $status = 404, $model = null, $path = null, $write = FILE_APPEND)
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

        $errors = [
            'error'      => '{ '.$error.' }',
            'controller' => '{ '.$controller.' }',
            'action'     => '{ '.$action.' }',
            'module'     => '{ '.$modules.' }',
            'date'       => '{ '.$date.' }',
        ];

        if($model !== null)
        {
            $errors['model'] = '{ '.$model.' }';
        }

        try {
            file_put_contents($log_file, Json::htmlEncode($errors), $write);
        }
        catch (\Exception $e){
            throw new HttpException(404, $e->getMessage());
        }

    }

    public function getUsers($params = []): array
    {
        if(empty($params)){
            try {
                $users = Users::find()->asArray()->all();
            }
            catch (\Exception $e){
                throw new HttpException(404,$e->getMessage());
            }

            return $users;
        }
    }


    public function afterValidate()
    {
        if($this->hasErrors()){
            $res = [
                'status' => 'error',
                'table' => self::tableName() ?? '',
                'url' => \yii\helpers\Url::current([], true),
                'message' => $this->getErrors(),
            ];
            $log_error = $this->createFolderLog();

            if(empty($log_error)){
                $res['empty'] = Yii::t('app', 'File not created');
                throw new HttpException(404, Yii::t('app', Json::htmlEncode($res)));
            }

            try{
                file_put_contents($log_error, Json::htmlEncode($res), FILE_APPEND);
            }catch (\Exception $e){
                throw new HttpException(404, Yii::t('app', Json::htmlEncode($e->getMessage())));
            }
        }
    }
}