<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%level_access}}`.
 */
class m190426_075817_create_level_access_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('level_access', [
            'id_level' => $this->primaryKey(),
            'number_lvl' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('level_access');
    }
}
