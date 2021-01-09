<?php /** @noinspection ALL */


namespace app\models;

use app\components\CustomBehaviors\CustomBehaviors;
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

    private function createFolderLog(){
        $year   = date('Y-m');
        $path = Yii::getAlias('@runtime').'/errors/'.$year;

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