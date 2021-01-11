<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hr_employee}}`.
 */
class m210108_114558_create_hr_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hr_employee}}', [
            'id' => $this->primaryKey(),
            'fish' => $this->char(50)->notNull(),
            'email' => $this->char(50)->unique()->notNull(),
            'phone' => $this->char(20)->notNull(),
            'images' => $this->char(50),
            'files' => $this->char(50),
            'pasport_seria' => $this->char(20)->unique()->notNull(),
            'address' => $this->char(50),
            'status' => $this->tinyInteger(),
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
        $this->dropTable('{{%hr_employee}}');
    }
}
