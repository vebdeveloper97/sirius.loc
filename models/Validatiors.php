<?php /** @noinspection ALL */


namespace app\models;

use Yii;
use yii\helpers\Json;
use yii\web\HttpException;

class Validatiors extends Logger
{
    public function afterValidate()
    {
        if($this->hasErrors()){
            $res = [
                'status' => 'error',
                'table' => self::tableName() ?? '',
                'url' => \yii\helpers\Url::current([], true),
                'message' => $this->getErrors(),
                'this_model' => self::class
            ];

            try {
                self::ExceptionLogger($res,404);
            }
            catch (\Exception $e)
            {
                throw new HttpException(404,Yii::t('app', 'Could not write to log file '.$e));
            }
        }
    }
}