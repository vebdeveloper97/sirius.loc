<?php /** @noinspection ALL */

namespace app\modules\rbac\models;

use app\models\BaseModel;
use app\modules\users\models\Users;
use Yii;
use yii\base\ErrorException;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;

/**
 * This is the model class for table "{{%auth_assignment}}".
 *
 * @property string $item_name
 * @property string $user_id
 * @property int|null $created_at
 *
 * @property AuthItem $itemName
 */
class AuthAssignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_assignment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at'], 'integer'],
            [['item_name', 'user_id'], 'string', 'max' => 64],
            [['item_name', 'user_id'], 'unique', 'targetAttribute' => ['item_name', 'user_id']],
            [['item_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['item_name' => 'name']],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)){
            if($this->isNewRecord){
                $this->created_at = strtotime("now");
            }
            return true;
        }else{
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_name' => Yii::t('app', 'Item Name'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[ItemName]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'item_name']);
    }

    public static function UsersSelects(): array
    {
        try {
            $model = BaseModel::getUsers();
            if(is_array($model)){
                return ArrayHelper::map($model,'id', 'username');
            }
        } catch (ErrorException $e) {
            throw new ErrorException($e->getMessage(),  422);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 'error', 421);
        } catch (HttpException $e) {
            throw new HttpException(404,$e->getMessage());
        }
    }

    public static function getAuthItems(){
        $auths = AuthItem::getItemsName();

        if(empty($auths)){
            return [];
        }

        return ArrayHelper::map($auths, 'name','name');
    }

    public static function getUsername($id){
        try {
            $model = Users::findOne($id);
        }
        catch (\Exception $e){
            throw new Exception($e->getMessage(), 'error', 404);
        }
        return !empty($model) ? $model : Yii::t('app', 'not detected');
    }

}
