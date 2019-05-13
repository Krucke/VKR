<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id_order
 * @property int $number_order
 * @property string $date_created
 * @property int $customer_id
 * @property int $emp_id
 * @property int $status_id
 *
 * @property Customer $customer
 * @property Employees $emp
 * @property StatusOrder $status
 * @property Trans[] $trans
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number_order', 'date_created', 'status_id'], 'required'],
            [['number_order', 'customer_id', 'emp_id', 'status_id'], 'integer'],
            [['date_created'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id_customer']],
            [['emp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['emp_id' => 'id_emp']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusOrder::className(), 'targetAttribute' => ['status_id' => 'id_status']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_order' => 'Id Order',
            'number_order' => 'Number Order',
            'date_created' => 'Date Created',
            'customer_id' => 'Customer ID',
            'emp_id' => 'Emp ID',
            'status_id' => 'Status ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id_customer' => 'customer_id']);
    }


    public function NumOrder(){

      return $query = Yii::$app->db->createCommand("SELECT count(id_order) from  `ORDER`")->queryScalar();
    }

    public function LastId(){

      return $query = Yii::$app->db->createCommand("SELECT id_order from `ORDER` ORDER BY id_order DESC LIMIT 1")->queryScalar();
    }

    public function NewOrdersCount(){

      return $query = Yii::$app->db->createCommand("SELECT count(*) from `ORDER` where status_id = 1")->queryScalar();
    }

    public function NewOrders(){

      return $query = Yii::$app->db->createCommand("SELECT * from `ORDER` where status_id = 1")->query();
    }


    public function AllOrders(){

      return static::find()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmp()
    {
        return $this->hasOne(Employees::className(), ['id_emp' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(StatusOrder::className(), ['id_status' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrans()
    {
        return $this->hasMany(Trans::className(), ['order_id' => 'id_order']);
    }
}
