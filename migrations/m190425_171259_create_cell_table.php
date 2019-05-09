<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cell}}`.
 */
class m190425_171259_create_cell_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cells', [
            'id_cell' => $this->primaryKey(),
            'number_cell' => $this->string(3)->notNull(),
            'max_qty' => $this->integer(3)->defaultValue(100)->notNull(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('cell');
    }
}
