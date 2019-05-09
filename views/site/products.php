<?php

use app\models\Product;
use app\models\Author;
$this->title = 'Товары';
?>
<h2 class="text-center mt-4 mb-4">Товары</h2>
<form action="" class="col-12" id="form">
  <input type="text" name="referal" value="" class="form-control col-md-12 who mb-3 mt-3" id="textsearch" autocomplete="off" placeholder="Поиск по данным о книге...">
</form>
<table class="table table-hover text-center table-bordered" style="font-size:16px;">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Название книги</th>
      <th scope="col">Код ISBN</th>
      <th scope="col">Цена,руб</th>
      <th scope="col">Количество</th>
      <th scope="col">Поставщик</th>
      <th scope="col">Автор</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($products as $prod): ?>

    <tr>
      <td><?=$prod['name_prod']?></th>
      <td><?=$prod['kod_ISBN']?></td>
      <td><?=$prod['price_prod']?></td>
      <td><?=$prod['qty_prod']?></td>
      <td>
        <?php

          $product = Product::findOne($prod['id_product']);
          $supp = $product->sup;
          echo $supp->name_sup;
        ?>
      </td>
      <td>
        <?php

        $product1 = Product::findOne($prod['id_product']);
        $au = $product->au;
        echo $au->lastname_au." ".$au->firstanme_au;
        ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<script>
  $(document).ready(function(){
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
    })
  })
</script>
