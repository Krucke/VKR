<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id_emp
 * @property string $lastname_emp
 * @property string $firstname_emp
 * @property string $otch_emp
 * @property string $date_employment
 * @property string $login_emp
 * @property string $pass_emp
 * @property string $img_emp
 * @property int $auth_key
 * @property int $post_id
 *
 * @property Post $post
 * @property Order[] $orders
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lastname_emp', 'firstname_emp', 'otch_emp', 'date_employment', 'login_emp', 'pass_emp', 'img_emp','post_id'], 'required'],
            [['date_employment'], 'safe'],
            [['img_emp'], 'string'],
            [['auth_key', 'post_id'], 'integer'],
            [['lastname_emp'], 'string', 'max' => 50],
            [['firstname_emp', 'otch_emp'], 'string', 'max' => 30],
            [['login_emp'], 'string', 'max' => 60],
            [['pass_emp'], 'string', 'max' => 60],
            [['login_emp'], 'unique'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id_post']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_emp' => 'Id Emp',
            'lastname_emp' => 'Lastname Emp',
            'firstname_emp' => 'Firstname Emp',
            'otch_emp' => 'Otch Emp',
            'date_employment' => 'Date Employment',
            'login_emp' => 'Login Emp',
            'pass_emp' => 'Pass Emp',
            'img_emp' => 'Img Emp',
            'auth_key' => 'Auth Key',
            'post_id' => 'Post ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id_post' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['emp_id' => 'id_emp']);
    }

    public function getEmp(){

      return static::find()->all();
    }

    public function DeleteEmp($id){

      return $query = Yii::$app->db->createCommand("delete from employees where id_emp = {$id}")->query();
    }

}
