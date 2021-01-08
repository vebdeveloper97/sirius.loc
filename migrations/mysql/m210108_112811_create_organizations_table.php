<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%organizations}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%organizations}}`
 */
class m210108_112811_create_organizations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%organizations}}', [
            'id' => $this->primaryKey(),
            'name' => $this->char(50)->notNull(),
            'parent_id' => $this->integer(),
            'address' => $this->char(50)->notNull(),
            'phone' => $this->char(20)->notNull(),
            'director' => $this->char(50)->notNull(),
            'telegram' => $this->char(50),
            'instagram' => $this->char(50),
            'web_site' => $this->char(50),
            'unique_number' => $this->char(20)->unique(),
            'status' => $this->tinyInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `parent_id`
        $this->createIndex(
            '{{%idx-organizations-parent_id}}',
            '{{%organizations}}',
            'parent_id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops index for column `parent_id`
        $this->dropIndex(
            '{{%idx-organizations-parent_id}}',
            '{{%organizations}}'
        );

        $this->dropTable('{{%organizations}}');
    }
}
