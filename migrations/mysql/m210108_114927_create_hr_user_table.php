<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hr_user}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 */
class m210108_114927_create_hr_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hr_user}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'hr_id' => $this->integer()->notNull(),
            'status' => $this->tinyInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-hr_user-user_id}}',
            '{{%hr_user}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-hr_user-user_id}}',
            '{{%hr_user}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-hr_user-user_id}}',
            '{{%hr_user}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-hr_user-user_id}}',
            '{{%hr_user}}'
        );

        $this->dropTable('{{%hr_user}}');
    }
}
