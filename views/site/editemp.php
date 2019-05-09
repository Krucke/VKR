<?php

$this->title = 'Редактирование профиля';
?>
<h2 class="text-center mt-5 mb-3">Редактирование пользователя <?=$emp['lastname_emp']." ".$emp['firstname_emp']." ".$emp['otch_emp']?></h2>
<form class="" action="/site/editemp?id=<?=$emp['id_emp']?>" method="post">
  <div class="form-group">
    <label for="lastname">Фамилия сотрудника</label>
    <input type="text" class="form-control" id="lastname" placeholder="Введите новую фамилию сотрудника..." name="lastname" value="<?=$emp['lastname_emp']?>" required>
  </div>
  <div class="form-group">
    <label for="firstname">Имя сотрудника</label>
    <input type="text" class="form-control" id="firstname" placeholder="Введите новое имя сотрудника..." name="firstname" value="<?=$emp['firstname_emp']?>" required>
  </div>
  <div class="form-group">
    <label for="otch">Отчество сотрудника</label>
    <input type="text" class="form-control" id="otch" placeholder="Введите новое отчество сотрудника..." name="otch" value="<?=$emp['otch_emp']?>" required>
  </div>
  <div class="form-group">
    <label for="login">Логин сотрудника</label>
    <input type="text" class="form-control" id="login" placeholder="Введите логин сотрудника..." name="login" value="<?=$emp['login_emp']?>" readonly>
  </div>
  <div class="form-group">
    <label for="password">Пароль сотрудника</label>
    <input type="password" class="form-control" id="password" placeholder="Введите пароль сотрудника..." name="password" value="<?=$emp['pass_emp']?>" readonly>
  </div>
  <div class="form-group">
    <label for="datead">Дата приема на работу</label>
    <input type="text" class="form-control" id="datead" name="datead" readonly value="<?=$emp['date_employment']?>">
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
  <button type="submit" name="editemp" class="btn button__dark btn-primary d-flex float-right">Сохранить</button>
  <div class="clearfix"></div>
</form>
