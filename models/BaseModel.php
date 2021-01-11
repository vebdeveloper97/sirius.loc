<?php /** @noinspection ALL */


namespace app\models;

use app\components\CustomBehaviors\CustomBehaviors;
use app\modules\users\models\Users;
use http\Url;
use phpDocumentor\Reflection\Types\Self_;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\HttpException;

class BaseModel extends Validatiors
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

    public function getUsers($params = []): array
    {
        if(empty($params)){
            try {
                $users = Users::find()->asArray()->all();
            }
            catch (\Exception $e){
                self::ExceptionLogger($e->getMessage(), 404);
                throw new HttpException(404,$e->getMessage());
            }

            return $users;
        }
    }

}