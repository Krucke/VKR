<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m190426_091603_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id_order' => $this->primaryKey(),
            'number_order' => $this->integer()->notNull(),
            'date_created' => $this->date()->notNull(),
            'time_created' => $this->time()->notNull(),
            'customer_id'  => $this->integer()->notNull(),
            'emp_id'  => $this->integer()->notNull(),
            'status_id'  => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-order-customer_id',
            'order',
            'customer_id'
        );

        $this->addForeignKey(
            'fk-order-customer_id',
            'order',
            'customer_id',
            'customer',
            'id_customer',
            'CASCADE'
        );

        $this->createIndex(
            'idx-order-emp_id',
            'order',
            'emp_id'
        );

        $this->addForeignKey(
            'fk-order-emp_id',
            'order',
            'emp_id',
            'employees',
            'id_emp',
            'CASCADE'
        );

        $this->createIndex(
            'idx-order-status_id',
            'order',
            'status_id'
        );

        $this->addForeignKey(
            'fk-order-status_id',
            'order',
            'status_id',
            'status_order',
            'id_status',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
