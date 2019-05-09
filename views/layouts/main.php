<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use app\assets\AppAsset;
use app\models\User;
use app\models\Employees;
use app\models\Post;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/logo/logo.png']) ?>
    <?php $this->registerCsrfMetaTags() ?>
     <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
  <?php
    if (!Yii::$app->user->isGuest) {
  ?>
  <input type="checkbox" id="nav-toggle" hidden>
  <label for="nav-toggle" class="nav-toggle" onclick></label>
  <aside class="control_panel" id="control_panel">
    <div class="control_panel__top">
      <div class="logo">
        <img src="../logo/logo.png" alt="logo" class="logo__img">
        <div class="logo__brand">
          <h2 class="brand__name">ЭКСМО</h2>
          <h6 class="brand__group">Издательская группа</h6>
        </div>
      </div>
    </div>
    <div class="control_panel__bottom">
      <div class="profile_user">
        <img src="<?=Yii::$app->user->identity->img_emp?>" alt="" class="profile_user__img">
        <div class="profile_user__info">
          <h4 class="profile_user__name mb-2"><?=Yii::$app->user->identity->lastname_emp?> <?=Yii::$app->user->identity->firstname_emp?></h4>
          <h5 class="profile_user__post"><?=Yii::$app->user->identity->post->name_post?></h5>
        </div>
      </div>
      <nav class="navigation">
        <ul class="navigation__menu">
          <li class="menu__item down"><a href="" class="menu__link"><i class="fas fa-shopping-cart"></i>Закупка товара <i class="arrow__right"></i></a>
            <ul class="submenu">
              <li class="submenu__item"><a href="/site/suppliers" class="submenu__link">Поставщики</a></li>
              <li class="submenu__item"><a href="/site/products" class="submenu__link">Товары поставщиков</a></li>
            </ul>
          </li>
          <li class="menu__item down"><a href="" class="menu__link"><i class="fas fa-truck-loading"></i>Принятие поставки <i class="arrow__right"></i></a>
            <ul class="submenu">
              <li class="submenu__item"><a href="" class="submenu__link">Underpoint 1</a></li>
              <li class="submenu__item"><a href="" class="submenu__link">Underpoint 2</a></li>
            </ul>
          </li>
          <li class="menu__item down"><a href="" class="menu__link"><i class="fas fa-people-carry"></i>Хранение товара <i class="arrow__right"></i></a>
            <ul class="submenu">
              <li class="submenu__item"><a href="" class="submenu__link">Underpoint 1</a></li>
              <li class="submenu__item"><a href="" class="submenu__link">Underpoint 2</a></li>
            </ul>
          </li>
          <li class="menu__item down"><a href="" class="menu__link"><i class="fas fa-users"></i>Сотрудники <i class="arrow__right"></i></a>
            <ul class="submenu">
              <li class="submenu__item"><a href="/site/employees" class="submenu__link">Таблица сотрудников</a></li>
              <li class="submenu__item"><a href="/site/addemp" class="submenu__link">Добавление сотрудника</a></li>
            </ul>
          </li>
          <li class="menu__item down"><a href="" class="menu__link"><i class="fas fa-paste"></i>Обратная связь <i class="arrow__right"></i></a>
            <ul class="submenu">
              <li class="submenu__item"><a href="/site/contact" class="submenu__link">Создание письма</a></li>
              <li class="submenu__item"><a href="" class="submenu__link">Underpoint 2</a></li>
            </ul>
          </li>
          <li class="menu__item"><a href="/site/logout" class="">Выйти из профиля</a></li>
        </ul>
      </nav>
    </div>
  </aside>
  <?php }
  else {
     $this->render('/site/login');
  }
  ?>
  <main class="container">
    <?= $content ?>
  </main>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
Swal(
"fdsf"
);
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.down').click(function(){
      $(this).find('.submenu').slideToggle("250");
      $(this).toggleClass('active_li');
      $(this).find('.arrow__right').toggleClass('active');
    });
  });
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
