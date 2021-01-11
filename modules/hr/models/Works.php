<?php

namespace app\modules\hr\models;

use Yii;

/**
 * This is the model class for table "{{%works}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $year_start
 * @property string|null $year_end
 * @property string|null $info
 * @property string|null $files
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property HrWorks[] $hrWorks
 */
class Works extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%works}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['year_start', 'year_end'], 'safe'],
            [['info'], 'string'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'files'], 'string', 'max' => 50],
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
            'year_start' => Yii::t('app', 'Year Start'),
            'year_end' => Yii::t('app', 'Year End'),
            'info' => Yii::t('app', 'Info'),
            'files' => Yii::t('app', 'Files'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[HrWorks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHrWorks()
    {
        return $this->hasMany(HrWorks::className(), ['work_id' => 'id']);
    }
}
