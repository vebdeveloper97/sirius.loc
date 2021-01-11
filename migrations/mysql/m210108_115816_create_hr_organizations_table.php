<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hr_organizations}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%hr_employee}}`
 * - `{{%organizations}}`
 */
class m210108_115816_create_hr_organizations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hr_organizations}}', [
            'id' => $this->primaryKey(),
            'hr_id' => $this->integer()->notNull(),
            'organization_id' => $this->integer()->notNull(),
            'status' => $this->tinyInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `hr_id`
        $this->createIndex(
            '{{%idx-hr_organizations-hr_id}}',
            '{{%hr_organizations}}',
            'hr_id'
        );

        // add foreign key for table `{{%hr_employee}}`
        $this->addForeignKey(
            '{{%fk-hr_organizations-hr_id}}',
            '{{%hr_organizations}}',
            'hr_id',
            '{{%hr_employee}}',
            'id',
            'CASCADE'
        );

        // creates index for column `organization_id`
        $this->createIndex(
            '{{%idx-hr_organizations-organization_id}}',
            '{{%hr_organizations}}',
            'organization_id'
        );

        // add foreign key for table `{{%organizations}}`
        $this->addForeignKey(
            '{{%fk-hr_organizations-organization_id}}',
            '{{%hr_organizations}}',
            'organization_id',
            '{{%organizations}}',
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
            '{{%fk-hr_organizations-hr_id}}',
            '{{%hr_organizations}}'
        );

        // drops index for column `hr_id`
        $this->dropIndex(
            '{{%idx-hr_organizations-hr_id}}',
            '{{%hr_organizations}}'
        );

        // drops foreign key for table `{{%organizations}}`
        $this->dropForeignKey(
            '{{%fk-hr_organizations-organization_id}}',
            '{{%hr_organizations}}'
        );

        // drops index for column `organization_id`
        $this->dropIndex(
            '{{%idx-hr_organizations-organization_id}}',
            '{{%hr_organizations}}'
        );

        $this->dropTable('{{%hr_organizations}}');
    }
}
