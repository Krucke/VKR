<?php

use app\models\StatusOrder;
$this->title = "Заказы для комплектовки";
?>
<style media="screen">
  a{
    color: black;
  }
  a:hover{
    transition: 0.4s;
    color: grey;
  }
</style>
<h2 class="text-center mt-4 mb-3">Заказы для комплектовки</h2>
<table class="table text-center table-hover">
  <thead class="thead-dark">
    <th scope="col">Номер заказа</th>
    <th scope="col">Дата создания заказа</th>
    <th scope="col">Статус заказа</th>
    <th scope="col">Действия</th>
  </thead>
  <tbody>
    <?php foreach ($orders as $order): ?>
      <tr>
        <td><?=$order['number_order']?></td>
        <td><?=$order['date_created']?></td>
        <td><?php $status = StatusOrder::findOne($order['status_id']);echo $status['name_status_order'];?></td>
        <td><a href="/site/compliteorder?id=<?=$order['id_order']?>"><i class="fas fa-check-circle"></i></a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
