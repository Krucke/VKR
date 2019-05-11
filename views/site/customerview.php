<?php

  use app\models\Product;
  $this->title = "Добавление товаров для заказа";
?>
<h2 class="text-center mt-4 mb-4">Товары</h2>
<form action="" class="col-12" id="form">
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
<script>
  $(document).ready(function(){
    var name_prod, qty, qtyall;
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
      qtyall = $(this).find('#qty').text().trim();
      $('#modal').modal('show');
      $('#addtoorder').click(function(){
        qty = $('#qty_prod').val().trim();
        if(qty < qtyall){

          console.log("Чотко");
        }
        else {
          console.log("Нет необходимого количества товара на складе, введите меньше");
        }
      });
    });
  })
</script>
