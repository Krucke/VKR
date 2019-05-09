<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id_product
 * @property string $name_prod
 * @property string $kod_ISBN
 * @property double $price_prod
 * @property int $qty_prod
 * @property int $rated_prod
 * @property int $sup_id
 * @property int $au_id
 * @property int $cell_id
 *
 * @property Author $au
 * @property Cells $cell
 * @property Supplier $sup
 * @property Trans[] $trans
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_prod', 'kod_ISBN', 'price_prod', 'qty_prod', 'rated_prod', 'sup_id', 'au_id', 'cell_id'], 'required'],
            [['price_prod'], 'number'],
            [['qty_prod', 'rated_prod', 'sup_id', 'au_id', 'cell_id'], 'integer'],
            [['name_prod'], 'string', 'max' => 100],
            [['kod_ISBN'], 'string', 'max' => 18],
            [['au_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::className(), 'targetAttribute' => ['au_id' => 'id_au']],
            [['cell_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cells::className(), 'targetAttribute' => ['cell_id' => 'id_cell']],
            [['sup_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['sup_id' => 'id_sup']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_product' => 'Id Product',
            'name_prod' => 'Name Prod',
            'kod_ISBN' => 'Kod Isbn',
            'price_prod' => 'Price Prod',
            'qty_prod' => 'Qty Prod',
            'rated_prod' => 'Rated Prod',
            'sup_id' => 'Sup ID',
            'au_id' => 'Au ID',
            'cell_id' => 'Cell ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAu()
    {
        return $this->hasOne(Author::className(), ['id_au' => 'au_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCell()
    {
        return $this->hasOne(Cells::className(), ['id_cell' => 'cell_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSup()
    {
        return $this->hasOne(Supplier::className(), ['id_sup' => 'sup_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrans()
    {
        return $this->hasMany(Trans::className(), ['prod_id' => 'id_product']);
    }

    public function all(){

      return static::find()->all();
    }
}
