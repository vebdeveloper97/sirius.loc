<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hr_position_con}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%hr_employee}}`
 * - `{{%hr_position}}`
 */
class m210108_115413_create_hr_position_con_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hr_position_con}}', [
            'id' => $this->primaryKey(),
            'hr_id' => $this->integer()->notNull(),
            'position_id' => $this->integer()->notNull(),
            'status' => $this->tinyInteger()->defaultValue(1),
        ]);

        // creates index for column `hr_id`
        $this->createIndex(
            '{{%idx-hr_position_con-hr_id}}',
            '{{%hr_position_con}}',
            'hr_id'
        );

        // add foreign key for table `{{%hr_employee}}`
        $this->addForeignKey(
            '{{%fk-hr_position_con-hr_id}}',
            '{{%hr_position_con}}',
            'hr_id',
            '{{%hr_employee}}',
            'id',
            'CASCADE'
        );

        // creates index for column `position_id`
        $this->createIndex(
            '{{%idx-hr_position_con-position_id}}',
            '{{%hr_position_con}}',
            'position_id'
        );

        // add foreign key for table `{{%hr_position}}`
        $this->addForeignKey(
            '{{%fk-hr_position_con-position_id}}',
            '{{%hr_position_con}}',
            'position_id',
            '{{%hr_position}}',
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
            '{{%fk-hr_position_con-hr_id}}',
            '{{%hr_position_con}}'
        );

        // drops index for column `hr_id`
        $this->dropIndex(
            '{{%idx-hr_position_con-hr_id}}',
            '{{%hr_position_con}}'
        );

        // drops foreign key for table `{{%hr_position}}`
        $this->dropForeignKey(
            '{{%fk-hr_position_con-position_id}}',
            '{{%hr_position_con}}'
        );

        // drops index for column `position_id`
        $this->dropIndex(
            '{{%idx-hr_position_con-position_id}}',
            '{{%hr_position_con}}'
        );

        $this->dropTable('{{%hr_position_con}}');
    }
}
