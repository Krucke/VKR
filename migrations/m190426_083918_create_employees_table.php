<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employees}}`.
 */
class m190426_083918_create_employees_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employees}}', [
            'id_emp' => $this->primaryKey(),
            'lastname_emp' => $this->string(50)->notNull(),
            'firstname_emp' => $this->string(30)->notNull(),
            'otch_emp' => $this->string(30),
            'date_employment' => $this->date()->notNull(),
            'login_emp' => $this->string(40)->notNull()->unique(),
            'pass_emp' => $this->string(16)->notNull(),
            'post_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-empolyees-post_id',
            'employees',
            'post_id'
        );

        $this->addForeignKey(
            'fk-employees-post_id',
            'employees',
            'post_id',
            'post',
            'id_post',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employees}}');
    }
}
