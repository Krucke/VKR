<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status_order".
 *
 * @property int $id_status
 * @property int $number_status
 *
 * @property Order[] $orders
 */
class StatusOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number_status'], 'required'],
            [['number_status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_status' => 'Id Status',
            'number_status' => 'Number Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['status_id' => 'id_status']);
    }

    /**
     * {@inheritdoc}
     * @return StatusOrderQuery the active query used by this AR class.
     */
}
