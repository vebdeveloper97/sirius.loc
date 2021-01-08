<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hr_works}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%hr_employee}}`
 * - `{{%works}}`
 */
class m210108_120320_create_hr_works_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hr_works}}', [
            'id' => $this->primaryKey(),
            'hr_id' => $this->integer()->notNull(),
            'work_id' => $this->integer()->notNull(),
            'status' => $this->tinyInteger()->defaultValue(1),
        ]);

        // creates index for column `hr_id`
        $this->createIndex(
            '{{%idx-hr_works-hr_id}}',
            '{{%hr_works}}',
            'hr_id'
        );

        // add foreign key for table `{{%hr_employee}}`
        $this->addForeignKey(
            '{{%fk-hr_works-hr_id}}',
            '{{%hr_works}}',
            'hr_id',
            '{{%hr_employee}}',
            'id',
            'CASCADE'
        );

        // creates index for column `work_id`
        $this->createIndex(
            '{{%idx-hr_works-work_id}}',
            '{{%hr_works}}',
            'work_id'
        );

        // add foreign key for table `{{%works}}`
        $this->addForeignKey(
            '{{%fk-hr_works-work_id}}',
            '{{%hr_works}}',
            'work_id',
            '{{%works}}',
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
            '{{%fk-hr_works-hr_id}}',
            '{{%hr_works}}'
        );

        // drops index for column `hr_id`
        $this->dropIndex(
            '{{%idx-hr_works-hr_id}}',
            '{{%hr_works}}'
        );

        // drops foreign key for table `{{%works}}`
        $this->dropForeignKey(
            '{{%fk-hr_works-work_id}}',
            '{{%hr_works}}'
        );

        // drops index for column `work_id`
        $this->dropIndex(
            '{{%idx-hr_works-work_id}}',
            '{{%hr_works}}'
        );

        $this->dropTable('{{%hr_works}}');
    }
}
