<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hr_not_accepted}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%hr_employee}}`
 */
class m210108_120518_create_hr_not_accepted_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hr_not_accepted}}', [
            'id' => $this->primaryKey(),
            'hr_id' => $this->integer()->notNull(),
            'info' => $this->text(),
            'status' => $this->tinyInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `hr_id`
        $this->createIndex(
            '{{%idx-hr_not_accepted-hr_id}}',
            '{{%hr_not_accepted}}',
            'hr_id'
        );

        // add foreign key for table `{{%hr_employee}}`
        $this->addForeignKey(
            '{{%fk-hr_not_accepted-hr_id}}',
            '{{%hr_not_accepted}}',
            'hr_id',
            '{{%hr_employee}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%hr_employee}}`
        $this->dropForeignKey(
            '{{%fk-hr_not_accepted-hr_id}}',
            '{{%hr_not_accepted}}'
        );

        // drops index for column `hr_id`
        $this->dropIndex(
            '{{%idx-hr_not_accepted-hr_id}}',
            '{{%hr_not_accepted}}'
        );

        $this->dropTable('{{%hr_not_accepted}}');
    }
}
