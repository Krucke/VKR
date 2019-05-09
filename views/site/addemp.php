<?php
  $this->title = 'Добавление сотрудника';
?>
<style media="screen">
  .row{
    height: 99vh;
    margin-top: -10px;
  }
</style>
<div class="row justify-content-center align-items-center">
  <div class="col-10">
    <h2 class="text-center mb-5">Добавление нового сотрудника</h2>
    <form class="" action="/site/addemp" method="post">
      <div class="form-group">
        <label for="lastname">Фамилия сотрудника</label>
        <input type="text" class="form-control" id="lastname" placeholder="Введите фамилию сотрудника" name="lastname">
      </div>
      <div class="form-group">
        <label for="firstname">Имя сотрудника</label>
        <input type="text" class="form-control" id="firstname" placeholder="Введите имя сотрудника" name="firstname">
      </div>
      <div class="form-group">
        <label for="otch">Отчество сотрудника</label>
        <input type="text" class="form-control" id="otch" placeholder="Введите отчество сотрудника" name="otch">
      </div>
      <div class="form-group">
        <label for="login">Логин сотрудника</label>
        <input type="text" class="form-control" id="login" placeholder="Введите логин сотрудника" name="login">
      </div>
      <div class="form-group">
        <label for="password">Пароль сотрудника</label>
        <input type="password" class="form-control" id="password" placeholder="Введите пароль сотрудника" name="password">
      </div>
      <div class="form-group">
        <label for="post">Должность</label>
        <select class="form-control" id="post" name="post">
          <?php
            foreach ($posts as $post):
          ?>
          <option value="<?=$post['id_post']?>"><?=$post['name_post']?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <button type="submit" name="addemp" class="btn button__dark btn-primary d-flex float-right">Добавить сотрудника</button>
      <div class="clearfix"></div>
    </form>
  </div>
</div>
