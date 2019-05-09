<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%supplier}}`.
 */
class m190425_170037_create_supplier_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('supplier', [
            'id_sup' => $this->primaryKey(),
            'name_sup' => $this->string(100)->notNull(),
            'adress_sup' => $this->string(255)->notNull(),
            'legal_entity' => $this->string(100)->notNull(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('supplier');
    }
}
