<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход в учетную запись';
?>
<style media="screen">
  .row{
    height: 99vh;
    margin-top: -50px;
 }
</style>
<div class="row justify-content-center align-items-center">
  <div class="col-8">
    <form>
      <h3 class="text-center text-uppercase m-4 color__black">Вход в систему</h3>
      <div class="form-group">
        <label for="login" class="color__black">Логин пользователя</label>
        <input type="text" name="login" class="form-control" id="login" placeholder="Введите логин" required>
      </div>
      <div class="form-group">
        <label for="password" class="color__black">Пароль пользователя</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Введите пароль" required>
        <p class="error mt-2 mb-2" style="display:none;font-size:17px;color:red;">Введен неправильный логин или пароль</p>
      </div>
      <small id="emailHelp" class="form-text text-muted float-left mt-2">При возникновении вопросов обращайтесь в тех. поддержку</small>
      <button type="button" name="signin" class="btn btn-primary float-right button__dark" id="emailHelp" aria-describedby="emailHelp">Войти в систему</button>
      <div class="clearfix"></div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.button__dark').click(function(){
      var login = $('#login').val();
      var password = $('#password').val();
      $.ajax({
        url: "/site/signin",
        type: "POST",
        data: ({login:login,pass:password}),
        dataType: "html",
        success: function(data){
          if(data == "has"){
            swal({
              title: "Вход в систему",
              text: "Вы успешно зашли в систему под логином "+login,
              icon: "success",
              button: "Продолжить",
            })
            .then(function(){

              window.location.replace("/site/suppliers");
            });
          }
          else {
            $('.button__dark').prop('disabled',true);
            $('.button__dark').css('background','grey');
            $('.error').css('display','block');
          }
        }
      });
      $('#login').keyup(function(){
        $('.error').css('display','none');
        $('.button__dark').css('background','#363845');
        $('.button__dark').prop('disabled',false);
      });
      $('#pass').keyup(function(){
        $('.error').css('display','none');
        $('.button__dark').css('background','#363845');
        $('.button__dark').prop('disabled',false);
      });
    });
  });
</script>
