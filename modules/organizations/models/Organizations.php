<?php

namespace app\modules\organizations\models;

use Yii;

/**
 * This is the model class for table "{{%organizations}}".
 *
 * @property int $id
 * @property string $name
 * @property int|null $parent_id
 * @property string $address
 * @property string $phone
 * @property string $director
 * @property string|null $telegram
 * @property string|null $instagram
 * @property string|null $web_site
 * @property string|null $unique_number
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property HrOrganizations[] $hrOrganizations
 */
class Organizations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%organizations}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'phone', 'director'], 'required'],
            [['parent_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'address', 'director', 'telegram', 'instagram', 'web_site'], 'string', 'max' => 50],
            [['phone', 'unique_number'], 'string', 'max' => 20],
            [['unique_number'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'director' => Yii::t('app', 'Director'),
            'telegram' => Yii::t('app', 'Telegram'),
            'instagram' => Yii::t('app', 'Instagram'),
            'web_site' => Yii::t('app', 'Web Site'),
            'unique_number' => Yii::t('app', 'Unique Number'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[HrOrganizations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHrOrganizations()
    {
        return $this->hasMany(HrOrganizations::className(), ['organization_id' => 'id']);
    }
}
