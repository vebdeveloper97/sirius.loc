<?php

namespace app\modules\hr\models;

use Yii;

/**
 * This is the model class for table "{{%hr_employee}}".
 *
 * @property int $id
 * @property string $fish
 * @property string $email
 * @property string $phone
 * @property string|null $images
 * @property string|null $files
 * @property string $pasport_seria
 * @property string|null $address
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property HrNotAccepted[] $hrNotAccepteds
 * @property HrOrganizations[] $hrOrganizations
 * @property HrPositionCon[] $hrPositionCons
 * @property HrWorks[] $hrWorks
 */
class HrEmployee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%hr_employee}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fish', 'email', 'phone', 'pasport_seria'], 'required'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['fish', 'email', 'images', 'files', 'address'], 'string', 'max' => 50],
            [['phone', 'pasport_seria'], 'string', 'max' => 20],
            [['email'], 'unique'],
            [['pasport_seria'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fish' => Yii::t('app', 'Fish'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'images' => Yii::t('app', 'Images'),
            'files' => Yii::t('app', 'Files'),
            'pasport_seria' => Yii::t('app', 'Pasport Seria'),
            'address' => Yii::t('app', 'Address'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[HrNotAccepteds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHrNotAccepteds()
    {
        return $this->hasMany(HrNotAccepted::className(), ['hr_id' => 'id']);
    }

    /**
     * Gets query for [[HrOrganizations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHrOrganizations()
    {
        return $this->hasMany(HrOrganizations::className(), ['hr_id' => 'id']);
    }

    /**
     * Gets query for [[HrPositionCons]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHrPositionCons()
    {
        return $this->hasMany(HrPositionCon::className(), ['hr_id' => 'id']);
    }

    /**
     * Gets query for [[HrWorks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHrWorks()
    {
        return $this->hasMany(HrWorks::className(), ['hr_id' => 'id']);
    }
}
