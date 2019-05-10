<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cells".
 *
 * @property int $id_cell
 * @property string $number_cell
 * @property int $max_qty
 * @property int $freely
 *
 * @property Product[] $products
 */
class Cells extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cells';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number_cell', 'freely'], 'required'],
            [['max_qty', 'freely'], 'integer'],
            [['number_cell'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cell' => 'Id Cell',
            'number_cell' => 'Number Cell',
            'max_qty' => 'Max Qty',
            'freely' => 'Freely',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['cell_id' => 'id_cell']);
    }

    public function AllCells(){

      return static::find()->all();
    }
}
