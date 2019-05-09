<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m190426_090321_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id_product' => $this->primaryKey(),
            'name_prod' => $this->string(100)->notNull(),
            'kod_ISBN' => $this->string(17)->notNull(),
            'price_prod' => $this->float(7,2)->notNull(),
            'qty_prod' => $this->integer()->notNull(),
            'rated_prod' => $this->integer()->notNull(),
            'sup_id' => $this->integer()->notNull(),
            'au_id' => $this->integer()->notNull(),
            'cell_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-product-sup_id',
            'product',
            'sup_id'
        );

        $this->addForeignKey(
            'fk-product-sup_id',
            'product',
            'sup_id',
            'supplier',
            'id_sup',
            'CASCADE'
        );

        $this->createIndex(
            'idx-product-au_id',
            'product',
            'au_id'
        );

        $this->addForeignKey(
            'fk-product-au_id',
            'product',
            'au_id',
            'author',
            'id_au',
            'CASCADE'
        );

        $this->createIndex(
            'idx-product-cell_id',
            'product',
            'cell_id'
        );

        $this->addForeignKey(
            'fk-product-cell_id',
            'product',
            'cell_id',
            'cells',
            'id_cell',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
