<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%works}}`.
 */
class m210108_120110_create_works_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%works}}', [
            'id' => $this->primaryKey(),
            'name' => $this->char(50)->notNull(),
            'year_start' => $this->date(),
            'year_end' => $this->date(),
            'info' => $this->text(),
            'files' => $this->char(50),
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
        $this->dropTable('{{%works}}');
    }
}
