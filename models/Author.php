<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id_au
 * @property string $lastname_au
 * @property string $firstanme_au
 * @property string $otch_au
 *
 * @property Product[] $products
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lastname_au', 'firstanme_au', 'otch_au'], 'required'],
            [['lastname_au', 'firstanme_au', 'otch_au'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_au' => 'Id Au',
            'lastname_au' => 'Lastname Au',
            'firstanme_au' => 'Firstanme Au',
            'otch_au' => 'Otch Au',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['au_id' => 'id_au']);
    }
}
