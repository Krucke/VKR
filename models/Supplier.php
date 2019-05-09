<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property int $id_sup
 * @property string $name_sup
 * @property string $adress_sup
 * @property string $legal_entity
 * @property string $description_sup
 * @property string $img_sup
 *
 * @property Product[] $products
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_sup', 'adress_sup', 'legal_entity', 'description_sup', 'img_sup'], 'required'],
            [['description_sup', 'img_sup'], 'string'],
            [['name_sup', 'legal_entity'], 'string', 'max' => 100],
            [['adress_sup'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sup' => 'Id Sup',
            'name_sup' => 'Name Sup',
            'adress_sup' => 'Adress Sup',
            'legal_entity' => 'Legal Entity',
            'description_sup' => 'Description Sup',
            'img_sup' => 'Img Sup',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['sup_id' => 'id_sup']);
    }

    /**
     * {@inheritdoc}
     * @return SupplierQuery the active query used by this AR class.
     */
     public function getSuppliers(){

       return static::find()->all();
     }

     public function getSearch($text){

       return $command = Yii::$app->db->createCommand("SELECT * FROM SUPPLIER WHERE NAME_SUP LIKE '$text%'")->queryAll();
     }
}
