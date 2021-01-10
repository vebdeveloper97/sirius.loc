<?php

namespace app\modules\hr\models;

use Yii;

/**
 * This is the model class for table "{{%hr_position_con}}".
 *
 * @property int $id
 * @property int $hr_id
 * @property int $position_id
 * @property int|null $status
 *
 * @property HrEmployee $hr
 * @property HrPosition $position
 */
class HrPositionCon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%hr_position_con}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hr_id', 'position_id'], 'required'],
            [['hr_id', 'position_id', 'status'], 'integer'],
            [['hr_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrEmployee::className(), 'targetAttribute' => ['hr_id' => 'id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrPosition::className(), 'targetAttribute' => ['position_id' => 'id']],
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
            'position_id' => Yii::t('app', 'Position ID'),
            'status' => Yii::t('app', 'Status'),
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

    /**
     * Gets query for [[Position]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(HrPosition::className(), ['id' => 'position_id']);
    }
}
