<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%status_order}}`.
 */
class m190426_080114_create_status_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%status_order}}', [
            'id_status' => $this->primaryKey(),
            'number_status' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%status_order}}');
    }
}
