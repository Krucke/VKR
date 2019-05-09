<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Supplier;
use app\models\Employees;
use app\models\StatusOrder;
use app\models\Post;
use app\models\Product;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login','logout','suppliers','','site','/','/site','addemp','editemp','products','employees','contact'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['logout','suppliers','','site','/'],
                        'roles' => ['@'],
                    ],
                    [
                      'allow' => true,
                      'actions' => ['login'],
                      'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    // 'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSuppliers(){
      $model = new Supplier;
      $suppliers = $model->getSuppliers();
      return $this->render('suppliers',['suppliers' => $suppliers]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {

      return $this->render('login');
    }

    public function actionDeleteemp($id){

      $model = new Employees;
      $emp = $model->DeleteEmp($id);
      return $this->redirect(['/site/employees']);
    }

    public function actionProducts(){

      $model = new Product;
      $products = $model->all();
      return $this->render('products',['products' => $products]);
    }

    public function actionAddemp(){

      if(isset($_POST['addemp'])){

        $model = new Employees;
        $model->lastname_emp = $_POST['lastname'];
        $model->firstname_emp = $_POST['firstname'];
        $model->otch_emp = $_POST['otch'];
        $model->login_emp = $_POST['login'];
        $password = $_POST['password'];
        $model->pass_emp = Yii::$app->getSecurity()->generatePasswordHash($password);
        $model->date_employment = date('Y-m-d');
        $model->auth_key = 1;
        $model->post_id = $_POST['post'];
        $model->img_emp = "https://im0-tub-ru.yandex.net/i?id=a1fed43bdb3aad26e65eb28aac1ce05a&n=13";
        $model->save();
        return $this->redirect(['/site/employees']);
      }
      $model = new Post;
      $posts = $model->getPost();
      return $this->render('/site/addemp',['posts' => $posts]);
    }

    public function actionEmployees(){

      $model = new Employees;
      $employees = $model->getEmp();
      return $this->render('/site/employees',['employees' => $employees]);
    }

    public function actionEditemp($id){

      if (isset($_POST['editemp'])) {
        $model = Employees::findOne($id);
        $model->lastname_emp = $_POST['lastname'];
        $model->firstname_emp = $_POST['firstname'];
        $model->otch_emp = $_POST['otch'];
        $model->auth_key = 1;
        $model->post_id = $_POST['post'];
        $model->img_emp = "https://im0-tub-ru.yandex.net/i?id=a1fed43bdb3aad26e65eb28aac1ce05a&n=13";
        $model->save();
        return $this->redirect(['/site/employees']);
      }
      $model = new Employees;
      $emp = $model->findOne($id);
      $model2 = new Post;
      $posts = $model2->getPost();
      return $this->render('editemp',['emp' => $emp,'posts' => $posts]);
    }

    public function actionContact(){

      if(isset($_POST['comment'])){
        Yii::$app->mailer->compose()
            ->setTo('Bandito14@yandex.ru')
            ->setFrom(['Bandito14@yandex.ru' => $_POST['email']])
            ->setSubject($_POST['title'])
            ->setTextBody($_POST['desc'])
            ->send();
            return $this->redirect(['/site/contact']);
      }
      return $this->render('contact');
    }

    public function actionExample(){
      $name_sup = $_POST['referal'];
      $data = Yii::$app->db->createCommand("SELECT * FROM SUPPLIER WHERE NAME_SUP LIKE '$name_sup%'")->queryAll();
      foreach ($data as $key) {
      echo "\n<li>".$key['name_sup']."</li>"; //$row["name"] - имя поля таблицы
      };
      // foreach ($data as $dat) {
      //   echo "<h1>dfgdfg</h1>";
      // }
      // return $this->render('suppliers',['suppliers' => $data]);
      // $name_sup = $_POST['title'];
      // echo $name_sup;
    }

    public function actionSignin(){

      if(isset($_POST['login']) and isset($_POST['pass'])){
          $loginuser = $_POST['login'];
          $passworduser = $_POST['pass'];
          $user = User::findOne(['login_emp' => $loginuser]);
          if($user!=null){
            if($passworduser == Yii::$app->getSecurity()->validatePassword($passworduser, $user->pass_emp)){
              Yii::$app->user->login($user);
              echo "has";
            }
            else {
              echo "bad pas";
            }
          }
          else {
            echo "not find";
          }
      }
      // if(isset($_POST['signin'])){
      //
      //   $loginuser = $_POST['login'];
      //   $passworduser = $_POST['password'];
      //   $user = User::findOne(['login_emp' => $loginuser]);
      //   if($user!=null){
      //     if($user->pass_emp == $passworduser){
      //       Yii::$app->user->login($user);
      //       return $this->redirect(['/site/index']);
      //     }
      //     else {
      //       echo "bad pas";
      //     }
      //   }
      //   else {
      //     echo "not find";
      //   }
      // }
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }



    /**
     * Displays about page.
     *
     * @return string
     */
    // public function actionAbout()
    // {
    //     return $this->render('about');
    // }

}
