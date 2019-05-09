<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

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

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id_emp;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function findByUsername($login_emp){

      return static::findOne(['login_emp' => $login_emp]);
    }

    public function validatePassword($password)
  {
      return Yii::$app->security->validatePassword($password, $this->pass_emp);
  }

  /**
   * Generates password hash from password and sets it to the model
   *
   * @param string $password
   */
  public function setPassword($password)
  {
      $this->pass_emp = Yii::$app->security->generatePasswordHash($password);
  }



    public function rules()
    {
        return [
            [['lastname_emp', 'firstname_emp', 'otch_emp', 'date_employment', 'login_emp', 'pass_emp', 'img_emp', 'post_id'], 'required'],
            [['date_employment'], 'safe'],
            [['img_emp'], 'string'],
            [['auth_key', 'post_id'], 'integer'],
            [['lastname_emp'], 'string', 'max' => 50],
            [['firstname_emp', 'otch_emp'], 'string', 'max' => 30],
            [['login_emp'], 'string', 'max' => 40],
            [['pass_emp'], 'string', 'max' => 16],
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
}
