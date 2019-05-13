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
use app\models\Cells;
use app\models\Customer;
use app\models\Trans;
use app\models\Order;

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
                'only' => ['login','logout','suppliers','','site','/','/site','addemp','editemp','products','employees','contact','infoproducts','customerlogin','customerview','addordertodb','neworders','orders'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['logout','suppliers','','site','/','/site','addemp','editemp','products','employees','contact','infoproducts','orders','neworders'],
                        'roles' => ['@'],
                    ],
                    [
                      'allow' => true,
                      'actions' => ['login','customerlogin','customerview','addordertodb'],
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
    public function actionLogin(){

      return $this->render('login');
    }

    public function actionTest(){

      return $this->render('test');
    }

    public function actionDeleteemp($id){

      $model = new Employees;
      $emp = $model->DeleteEmp($id);
      return $this->redirect(['/site/employees']);
    }

    public function actionCheckcells(){

        $cell = Cells::findOne(['number_cell' => $_POST['incell']]);
        return $cell->freely;
    }

    public function actionProducts(){

      $model = new Product;
      $products = $model->all();
      return $this->render('products',['products' => $products]);
    }

    public function actionInventory(){

      return $this->render('inventory');
    }

    public function actionInfoproducts(){

      $modelprod = new Product();
      $products = $modelprod->all();
      $modelcells = new Cells();
      $cells = $modelcells->AllCells();
      return $this->render('infoprod',['products' => $products,'cells' => $cells]);
    }

    public function actionMovement(){
      if(isset($_POST['name']) and isset($_POST['cell']) and isset($_POST['qty']) and isset($_POST['incell'])){

        $fromcell = Cells::findOne(['number_cell' => $_POST['cell']]);
        $incell = Cells::findOne(['number_cell' => $_POST['incell']]);
        if($incell->freely >= $_POST['qty']){
          $prod = Product::findOne(['name_prod' => $_POST['name']]);
          $prod->cell_id = $incell->id_cell;
          $prod->save();
          $incell->freely = $incell->freely - $_POST['qty'];
          $incell->save();
          $fromcell->freely = $fromcell->freely + $_POST['qty'];
          $fromcell->save();
          return "ok";
        }
        return "cells";
      }
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

    public function actionCustomerlogin(){

      if(isset($_POST['signin'])){
        $INN = $_POST['INN'];
        $ORGN = $_POST['ORGN'];
        $cust = Customer::findOne(['INN' => $INN]);
        if($cust!=null){
          $custses = Yii::$app->session;
          $custses['INN'] = $INN;
          return $this->render('customerview');
        }
        else {
          echo "<script>
            alert('wrong INN');
          </script>";
        }
      }
      return $this->render('customerlogin');
    }

    public function actionCustomerview(){

      $products = Product::find()->all();
      return $this->render('customerview',['products' => $products]);
    }

    public function actionCreatingorder(){
      $session = Yii::$app->session;
      $session['order'];

      if(isset($_POST['name_prod']) and isset($_POST['qty_need'])){

        $products = Product::findOne(['name_prod' => $_POST['name_prod']]);
        $products->qty_prod -= $_POST['qty_need'];
        $products->save();
        $newprod = array('name_prod' => $_POST['name_prod'],'qty_prod' => $_POST['qty_need']);
        $RewriteSes = $session['order'];
        $RewriteSes[] = $newprod;
        $session['order'] = $RewriteSes;
        return "ok";
      }
    }

    public function actionAddordertodb(){
      if(isset($_POST['lol'])){

        $custses = Yii::$app->session;
        $session = Yii::$app->session;
        $customer = Customer::findOne(['INN' => $custses['INN']]);
        $num = Order::NumOrder();
        $id_order = Order::LastId();
        $order = new Order();
        $transaction = Yii::$app->db->beginTransaction();
        try {
          $order->number_order = $num+1;
          $order->date_created = date('Y-m-d');
          $order->customer_id = $customer->id_customer;
          $order->emp_id = "";
          $order->status_id = 1;
          $order->save();
          foreach ($session['order'] as $key => $value) {

            $prod = Product::findOne(['name_prod' => $value['name_prod']]);
            $trans = new Trans();
            $trans->date_trans = date('Y-m-d');
            $trans->time_trans = date('G:i:s');
            $trans->order_id = $id_order+1;
            $trans->prod_id = $prod['id_product'];
            $trans->qty_prod = $value['qty_prod'];
            $trans->save();
          }

          $transaction->commit();
          unset($session['order']);
          return "ok";
        }
        catch (\Exception $e) {
          $transaction->rollBack();
        }
      }

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
            if(Yii::$app->getSecurity()->validatePassword($passworduser, $user->pass_emp)){
              Yii::$app->user->login($user);
              return "has";
            }
            else {
              return "password";
            }
          }
          else {
            return "login";
          }
      }
    }


    public function actionOrders(){

      $model = new Order();
      $model1 = new Trans();
      $orders = $model->AllOrders();
      $trans = $model1->AllTrans();
      return $this->render('order',['orders' => $orders,'trans' => $trans]);
    }

    public function actionNeworders(){

      $model = new Order;
      $orders = $model->NewOrders();
      return $this->render('neworders',['orders' => $orders]);
    }

    public function actionTakeorder(){

      if(isset($_POST['id'])){
        $id = $_POST['id'];
        $order = Order::findOne(['id_order' => $id]);
        $order->status_id = 2;
        $order->emp_id = Yii::$app->user->identity->id_emp;
        $order->save();
        return "ok";
      }
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout(){
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
