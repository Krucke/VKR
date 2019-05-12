<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trans".
 *
 * @property int $id_trans
 * @property string $date_trans
 * @property string $time_trans
 * @property int $order_id
 * @property int $prod_id
 * @property int $qty_prod
 *
 * @property Order $order
 * @property Product $prod
 */
class Trans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_trans', 'time_trans', 'order_id', 'prod_id', 'qty_prod'], 'required'],
            [['date_trans', 'time_trans'], 'safe'],
            [['order_id', 'prod_id', 'qty_prod'], 'integer'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id_order']],
            [['prod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['prod_id' => 'id_product']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_trans' => 'Id Trans',
            'date_trans' => 'Date Trans',
            'time_trans' => 'Time Trans',
            'order_id' => 'Order ID',
            'prod_id' => 'Prod ID',
            'qty_prod' => 'Qty Prod',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id_order' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProd()
    {
        return $this->hasOne(Product::className(), ['id_product' => 'prod_id']);
    }
}
