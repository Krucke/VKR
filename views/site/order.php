<?php

  use app\models\Employees;
  use app\models\Trans;
  use app\models\Product;
  use app\models\Order;
  $this->title = "Заказы";
?>
<h2 class="text-center mt-4 mb-3">Заказы</h2>
<table class="table table-hover text-center">
  <thead class="thead-dark">
    <th scope="col">Номер заказа</th>
    <th scope="col">Дата создания заказа</th>
    <th scope="col">Сотрудник</th>
    <th scope="col">Статус заказа</th>
  </thead>
  <tbody>
    <?php
      foreach($orders as $order): ?>
    <tr>
      <td><?=$order['number_order']?></td>
      <td><?=$order['date_created']?></td>
      <td>
        <?php
          if($order->emp['lastname_emp'] == null){
            echo "-";
          }
          else {
        ?>
        <?=$order->emp['lastname_emp']." ".$order->emp['firstname_emp']." ".$order->emp['otch_emp']?>
        <?php } ?>
      </td>
      <td><?=$order->status['name_status_order']?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
