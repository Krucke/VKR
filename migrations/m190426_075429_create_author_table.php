<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m190426_075429_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('author', [
            'id_au' => $this->primaryKey(),
            'lastname_au' => $this->string(30)->notNull(),
            'firstanme_au' => $this->string(30)->notNull(),
            'otch_au' => $this->string(30)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('author');
    }
}
