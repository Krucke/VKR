<?php

$this->title = 'Отправка информации об ошибке';
?>
<style media="screen">
  .row{
    height: 99vh;
    margin-top: -30px;
  }
</style>
<div class="row justify-content-center align-items-center">
  <div class="col">
    <form class="" action="/site/contact" method="post">
      <h2 class="text-center mt-4 mb-3">Отправка информации об ошибке</h2>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?=Yii::$app->user->identity->email_em?>" readonly>
      </div>
      <div class="form-group">
        <label for="title">Тема</label>
        <input type="text" class="form-control" id="title" placeholder="Введите заголовок сообщения..." name="title" value="" required>
      </div>
      <div class="form-group">
        <label for="desc">Описание</label>
        <textarea type="text" class="form-control" id="desc" name="desc" placeholder="Введите описание проблемы..."></textarea>
      </div>
      <button type="submit" name="comment" class="btn btn-primary button__dark float-right">Отправить</button>
    </form>
  </div>
</div>
