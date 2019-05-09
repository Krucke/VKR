<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_db".
 *
 * @property string $first
 * @property string $second
 */
class TestDb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test_db';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first', 'second'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'first' => 'First',
            'second' => 'Second',
        ];
    }
}
