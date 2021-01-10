<?php

namespace app\modules\hr\models;

use Yii;

/**
 * This is the model class for table "{{%hr_not_accepted}}".
 *
 * @property int $id
 * @property int $hr_id
 * @property string|null $info
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property HrEmployee $hr
 */
class HrNotAccepted extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%hr_not_accepted}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hr_id'], 'required'],
            [['hr_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['info'], 'string'],
            [['hr_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrEmployee::className(), 'targetAttribute' => ['hr_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hr_id' => Yii::t('app', 'Hr ID'),
            'info' => Yii::t('app', 'Info'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Hr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHr()
    {
        return $this->hasOne(HrEmployee::className(), ['id' => 'hr_id']);
    }
}
