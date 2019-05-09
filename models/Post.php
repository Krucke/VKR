<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id_post
 * @property string $name_post
 * @property int $level_id
 *
 * @property Employees[] $employees
 * @property LevelAccess $level
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_post', 'level_id'], 'required'],
            [['level_id'], 'integer'],
            [['name_post'], 'string', 'max' => 100],
            [['level_id'], 'exist', 'skipOnError' => true, 'targetClass' => LevelAccess::className(), 'targetAttribute' => ['level_id' => 'id_level']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_post' => 'Id Post',
            'name_post' => 'Name Post',
            'level_id' => 'Level ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employees::className(), ['post_id' => 'id_post']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(LevelAccess::className(), ['id_level' => 'level_id']);
    }

    public function getPost(){

      return static::find()->all();
    }
}
