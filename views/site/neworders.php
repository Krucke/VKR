<?php
use app\models\StatusOrder;
$this->title = "Новые заказы";
?>
<h2 class="text-center mt-4 mb-3">Новые заказы</h2>
<table class="table table-hover text-center">
  <thead class="thead-dark">
    <th scope="col">Номер заказа</th>
    <th scope="col">Дата создания заказа</th>
    <th scope="col">Статус заказа</th>
    <th scope="col">Действия</th>
  </thead>
  <tbody>

    <?php

      if(count($orders) == 0){
    ?>
    <tr>
      <td colspan="4" class="text-left">На данный момент новых заказов нет.</td>
    </tr>
    <?php
      }
      else{
      foreach($orders as $order): ?>

    <tr>
      <td><?=$order['number_order']?></td>
      <td><?=$order['date_created']?></td>
      <td><?php $status = StatusOrder::findOne($order['status_id']);echo $status['name_status_order'];?></td>
      <td><button name="takeorder" id="takeorder" class="btn" data-id = "<?=$order['id_order']?>"><i class="fas fa-handshake"></i></button></td>
    </tr>
  <?php endforeach;} ?>
  </tbody>
</table>
<script type="text/javascript">
  $(document).ready(function(){
    $('.btn').click(function(){
      var a = $(this).attr('data-id');
      // console.log(a);
      swal({
        title:  "Подверждение принятия заказа",
        text:  "Вы уверены что хотите принять данный заказ?",
        icon:  "warning",
        buttons:{
          cancel: "Отмена",
          confirm:{
            text: "Принять",
            value: "take",
          },
        }
      })
      .then((take) =>{
        $.ajax({
          url: "/site/takeorder",
          type: "POST",
          data: ({id:a}),
          dataType: "html",
          success: function(data){
            if(data == "ok"){

              swal({
                title: "Принятие заказа",
                text: "Заказ успешно принят!",
                icon: "success",
              })
              .then(function(){

                window.location.replace('/site/orders');
              });
            }
          },
          error: function(){
            swal("Ошибка, Непредвиденная ошибка,error");
          }
        });
      });
    });
  });
</script>
