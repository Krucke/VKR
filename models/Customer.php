<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id_customer
 * @property string $name_customer
 * @property string $adress_customer
 * @property string $INN
 * @property string $ORGN
 *
 * @property Order[] $orders
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_customer', 'adress_customer', 'INN', 'ORGN'], 'required'],
            [['name_customer'], 'string', 'max' => 50],
            [['adress_customer', 'INN', 'ORGN'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_customer' => 'Id Customer',
            'name_customer' => 'Name Customer',
            'adress_customer' => 'Adress Customer',
            'INN' => 'Inn',
            'ORGN' => 'Orgn',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id_customer']);
    }
}
