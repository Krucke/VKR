<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%trans}}`.
 */
class m190426_092222_create_trans_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%trans}}', [
            'id_trans' => $this->primaryKey(),
            'date_trans' => $this->date()->notNull(),
            'time_trans' => $this->time()->notNull(),
            'order_id' => $this->integer()->notNull(),
            'prod_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-trans-order_id',
            'trans',
            'order_id'
        );

        $this->addForeignKey(
            'fk-trans-order_id',
            'trans',
            'order_id',
            'order',
            'id_order',
            'CASCADE'
        );

        $this->createIndex(
            'idx-trans-prod_id',
            'trans',
            'prod_id'
        );

        $this->addForeignKey(
            'fk-trans-prod_id',
            'trans',
            'prod_id',
            'product',
            'id_product',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%trans}}');
    }
}
