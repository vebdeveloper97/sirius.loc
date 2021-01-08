<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hr_position}}`.
 */
class m210108_115202_create_hr_position_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hr_position}}', [
            'id' => $this->primaryKey(),
            'name' => $this->char(50)->notNull(),
            'status' => $this->tinyInteger()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hr_position}}');
    }
}
