<?php

  use app\models\Product;
  use app\models\Order;
  $this->title = "Добавление товаров для заказа";
?>

<h2 class="text-center mt-4 mb-4">Товары</h2>
<form action="" class="col-12" id="form" method="post">
  <input type="text" name="referal" value="" class="form-control col-md-12 who mb-3 mt-3" id="textsearch" autocomplete="off" placeholder="Поиск по данным о книге...">
</form>
<table class="table table-hover text-center table-bordered" style="font-size:16px;">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Название книги</th>
      <th scope="col">Цена,руб</th>
      <th scope="col">Количество</th>
      <th scope="col">Автор</th>
      <th scope="col">Действия</th>
    </tr>
  </thead>
  <tbody>
    <?php $products = Product::find()->all(); foreach ($products as $prod): ?>

    <tr>
      <td id="name_prod"><?=$prod['name_prod']?></th>
      <td><?=$prod['price_prod']?></td>
      <td id="qty"><?=$prod['qty_prod']?></td>
      <td>
        <?php

        $product1 = Product::findOne($prod['id_product']);
        $au = $product1->au;
        echo $au->lastname_au." ".$au->firstanme_au." ".$au->otch_au;
        ?>
      </td>
      <td><button type="button" data-toggle="modal" data-target="#exampleModalCenter" id="addprod" class="btn"><i class="fas fa-cart-plus"></i></button></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Добавление товара</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="qty_prod">Введите количество товара</label>
        <input type="text" name="" value="" id="qty_prod" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <button type="button" class="btn btn-primary" id="addtoorder">Добавить к заказу</button>
      </div>
    </div>
  </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Подтверждение заказа
</button>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Подтверждение заказа</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        $session = Yii::$app->session;
          if($session['order'] == NULL){
            echo "<p id='text_order'>Вы еще ничего не добавили к Вашему заказу. <i class='fas fa-frown'></i></p>";
          }
          else {

        ?>
        <table class="table table-hover text-center table-bordered">
          <thead>
            <tr>
              <th scope="col">Номер</th>
              <th scope="col">Название товара</th>
              <th scope="col">Количество</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $session = Yii::$app->session;
              if(isset($session['order'])){
                foreach($session['order'] as $order => $val):
            ?>
            <tr>
              <td><?=$order+1?></td>
              <td><?=$val['name_prod']?></td>
              <td><?=$val['qty_prod']?></td>
            </tr>
          <?php endforeach;} ?>
          </tbody>
        </table>
        <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <button type="button" class="btn btn-primary" id="saveorder">Подтвердить</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var text = $('#text_order').text();
  if(text!=""){
    $('#saveorder').prop('disabled',true);
  }
  else {
    $('#saveorder').prop('disabled',false);
  }
</script>
<script>
  $(document).ready(function(){
    var name_prod, qty_need, qtyall;
    $(".who").keyup(function(){
      _this = this;

      $.each($('table tbody tr'),function(){
        if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase())===-1){
          $(this).hide();
        }
        else {
          $(this).show();
        }
      });
    });
    $('table tbody tr').click(function(){
      name_prod = $(this).find('#name_prod').text().trim();
      qtyall = parseInt($(this).find('#qty').text().trim());
      $('#modal').modal('toggle');
      $('#addtoorder').click(function(){
        qty_need = parseInt($('#qty_prod').val());
        if(qty_need <= qtyall){
          $.ajax({
            url: "/site/creatingorder",
            type: "POST",
            dataType: "html",
            data: ({name_prod:name_prod,qty_need:qty_need}),
            success: function(data){
              if(data == "ok"){

                $('#qty_prod').val("");
                swal({
                  title: "Добавление товара",
                  text: "Товар "+name_prod+" в количестве "+qty_need+" шт. добавлен к вашему заказу!",
                  icon: "success",
                  button: "Продолжить оформление заказа",
                })
                .then(function(){
                  $('#modal').modal('toggle');
                  window.location.replace("/site/customerview");
                });
              }
            },
            error: function(){
              swal({
                title: "Ошибка",
                text:"Произошла ошибка при формировании заказа",
                icon: "error",
                button: "OK",
              })
              .then(function(){
                window.location.replace('/site/customerview');
              });
            }
          });
        }
        else {
          swal({
            title: "Ошибка",
            text: "Нет необходимо количества товара на складе!",
            icon: "error",
            button: "Ок",
          });
        }
      });
    });
  })
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#saveorder').on('click',function(){
      swal({
        title: "Подтверждение заказа",
        text:"Вы уверены, что выбрали нужные товары и хотите подтвердить заказ?",
        icon: "info",
        button: "Подтверждаю",
      })
      .then(function(){
        $.ajax({
          url: '/site/addordertodb',
          type: "POST",
          data: ({lol:"0"}),
          dataType: "html",
          success: function(data){
            if(data == "ok"){
              swal({
                title: "Подтверждение заказа",
                text:"Ваш заказ успешно сформирован",
                icon: "success",
                button: "OK",
              })
              .then(function(){
                window.location.replace('/site/customerview');
              });
            }
            else {
              alert('no');
            }
          },
          error: function(){
            swal({
              title: "Ошибка",
              text:"Произошла ошибка при формировании заказа",
              icon: "error",
              button: "OK",
            });
          }
        });
      });
    });
  });
</script>
