<?php /** @noinspection ALL */


namespace app\models;

use app\components\CustomBehaviors\CustomBehaviors;
use app\modules\rbac\models\AuthItem;
use app\modules\users\models\Users;
use http\Url;
use phpDocumentor\Reflection\Types\Self_;
use Yii;
use yii\base\ErrorException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\HttpException;

class BaseModel extends Validatiors
{
    const STATUS_ACTIVE   = 1;
    const STATUS_NOACTIVE = 2;
    const STATUS_SAVED    = 3;

    const PASSIV_RULE = 1;
    const ACTIVE_RULE = 2;

    public function behaviors()
    {
        $config = [];
        if($this instanceof AuthItem){
            $config = [
                TimestampBehavior::class,
            ];
            return $config;
        }
        return [
            TimestampBehavior::class,
            CustomBehaviors::class,
        ];
    }

    public static function getUsers($params = [], $type = 1): array
    {
        if(empty($params)){
            try {
                $users = Users::find()->asArray()->all();
            }
            catch (\Exception $e){
                throw new HttpException(404,$e->getMessage());
            }
        }
        else{
            $user = new Users();
            if(is_array($params)){
                foreach ($params as $key => $param) {
                    if(!$user->hasAttribute($key)){
                        throw new Exception(Yii::t('app', "The {$key} attribute was not found in the Users table"), 'error', 404);
                    }
                }

                if($type === 1){
                    $users = Users::find()
                        ->where($params)
                        ->asArray()
                        ->all();
                }elseif($type === 2){
                    $users = Users::find()
                        ->where($params)
                        ->one();
                }

            }else{
                throw new ErrorException(Yii::t('app', 'Send the parameter as an array'), 422);
            }
        }
        return $users;
    }

}