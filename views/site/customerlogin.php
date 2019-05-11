<?php

$this->title = "Авторизация заказчика";
?>
<style media="screen">
  .row{
    height: 99vh;
    margin-top: -50px;
 }
</style>
<div class="row justify-content-center align-items-center">
  <div class="col-8">
    <form action="/site/customerlogin" method="post">
      <h3 class="text-center text-uppercase m-4 color__black">Вход в систему</h3>
      <div class="form-group">
        <label for="login" class="color__black">ИНН</label>
        <input type="text" name="INN" class="form-control" id="login" placeholder="Введите логин" required>
      </div>
      <div class="form-group">
        <label for="password" class="color__black">ОРГН</label>
        <input type="password" name="ORGN" class="form-control" id="password" placeholder="Введите пароль" required>
        <p class="error mt-3" style="display:none;font-size:17px;color:red;"></p>
      </div>
      <button type="submit" name="signin" class="btn btn-primary float-right button__dark">Перейти к созданию заказа</button>
    </form>
  </div>
</div>
