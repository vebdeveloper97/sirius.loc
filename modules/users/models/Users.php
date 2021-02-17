<?php

namespace app\modules\users\models;

use app\models\BaseModel;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string|null $access_token
 * @property string|null $auth_key
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $last_activity
 * @property string|null $old_password
 *
 * @property HrUser[] $hrUsers
 */
class Users extends BaseModel
{
    public $repeat_password;
    public $old_password;

    const SCENARIO_NEWRECORD    = 'create';
    const SCENARIO_NOTNEWRECORD = 'update';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_NOTNEWRECORD] = ['password','old_password','repeat_password'];
        return $scenarios;
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if(empty($this->status)){
                $this->status = self::STATUS_ACTIVE;
            }

            if(!empty($this->password)){
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
            }

            if(empty($this->access_token)){
                $this->access_token = Yii::$app->security->generateRandomString(100);
            }

            if(empty($this->auth_key)){
                $this->auth_key = Yii::$app->security->generateRandomString(50);
            }

            if(empty($this->auth_key)){
                $this->auth_key = Yii::$app->security->generateRandomString(50);
            }

            return true;
        }
        else{
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                'old_password', 'findPasswords'
            ],
            [
                ['repeat_password', 'old_password', 'password'], 'required',
                'on' => self::SCENARIO_NOTNEWRECORD,
            ],
            [
                'repeat_password', 'compare', 'compareAttribute' => 'password',
                'message' => Yii::t('app', "Passwords don't match"),
                'on' => self::SCENARIO_NOTNEWRECORD
            ],
            [['username', 'password'], 'required'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['last_activity'], 'safe'],
            [['username', 'auth_key'], 'string', 'max' => 50],
            [['access_token'], 'string', 'max' => 100],
            [['old_password'], 'string', 'max' => 100],
            [['password'], 'string', 'min' => 6, 'max' => 15],
            [['username'], 'unique'],
        ];
    }

    public function findPasswords($attribute)
    {
        $user = self::findOne(['username' => $this->username]);
        if(!Yii::$app->security->validatePassword($this->old_password, $user->password)){
            $this->addError($attribute, Yii::t('app', 'Old password error'));
        }
    }

    public function getPasswordUnset($model)
    {
        if(strlen($model->password) > 15){
            unset($model->password);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'access_token' => Yii::t('app', 'Access Token'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'last_activity' => Yii::t('app', 'Last Activity'),
            'old_password' => Yii::t('app', 'Old Password'),
        ];
    }

    /**
     * Gets query for [[HrUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHrUsers()
    {
        return $this->hasMany(HrUser::className(), ['user_id' => 'id']);
    }
}
