<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m190426_082950_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id_post' => $this->primaryKey(),
            'name_post' => $this->string(100)->notNull(),
            'level_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-post-level_id',
            'post',
            'level_id'
        );

        $this->addForeignKey(
            'fk-post-level_id',
            'post',
            'level_id',
            'level_access',
            'id_level',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
