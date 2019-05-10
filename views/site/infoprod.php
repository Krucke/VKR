<?php

  use app\models\Product;
  use app\models\Cells;
  $this->title = 'Информация о размещении товаров';
?>
<style media="screen">
  .forfa{
    color: black;
  }
  .forfa:first-child{
    margin-right: 10px;
  }
  .forfa:hover{
    transition: 0.3s;
    color:grey
  }
</style>


<h3 class="text-center mt-3 mb-4">Информация о размещении товаров</h3>
<form action="" class="col-12" id="form">
  <input type="text" name="referal" value="" class="form-control col-md-12 who mb-3 mt-3" id="textsearch" autocomplete="off" placeholder="Поиск по данным о товаре...">
</form>
<table class="table table-hover text-center">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Название книги</th>
      <th scope="col">Код ISBN</th>
      <th scope="col">Количество</th>
      <th scope="col">Ячейка</th>
      <th scope="col">Свободно в ячейке</th>
      <th scope="col">Дейсвтия</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($products as $prod):
    ?>
    <tr>
      <td id="name_prod"><?=$prod['name_prod']?></th>
      <td><?=$prod['kod_ISBN']?></td>
      <td id="qty"><?=$prod['qty_prod']?></td>
      <td id="cell">
        <?php

          $prod1 = Product::findOne($prod['id_product']);
          $cells = $prod1->cell;
          echo $cells->number_cell;
        ?>
      </td>
      <td id="">
        <?php
          $prod2 = Product::findOne($prod['id_product']);
          $cells1 = $prod2->cell;
          echo $cells1->freely;
        ?>
      </td>
      <td><button type="button" class="btn infobut" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-people-carry forfa"></i></button><a href=""><i class="fas fa-eye forfa"></i></a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-center">Перемещение товаров</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="">
          <label for="nameprod1">Название товара</label>
          <input type="text" name="nameprod" id="nameprod1" class="form-control" value="" readonly>
          <label for="qtyprod1">Количество товара</label>
          <input type="text" name="qtyprod" id="qtyprod1" value="" class="form-control">
          <label for="fromcell">Из ячейки</label>
          <input type="text" name="nameprod" id="fromcell" value="" class="form-control" readonly>
          <label for="intocell">В ячейку</label>
          <select class="form-control" name="intocell" id="intocell">
            <?php
            $model = new Cells();
            $cells1 = $model->AllCells();
              foreach ($cells1 as $cell):
            ?>
            <option value="<?=$cell['id_cell']?>"><?=$cell['number_cell']?></option>
          <?php endforeach; ?>
          </select>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
            <button type="button" class="btn btn-primary save">Переместить</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('tr').click(function(){
      var name = $(this).find('#name_prod').text().trim();
      var cell = $(this).find('#cell').text().trim();
      var qty = $(this).find('#qty').text().trim();
      $('#nameprod1').prop('value',name);
      $('#qtyprod1').prop('value',qty);
      $('#fromcell').prop('value',cell);
      $('#modal').modal('show');
      $('.save').click(function(){
        var incell = $('#intocell').val();
        $.ajax({
          url: "/site/movement",
          type: "POST",
          data: ({name:name,cell:cell,qty:qty,incell:incell}),
          dataType: "html",
        });
      });
    });
  });
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
