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
          <input type="text" name="qtyprod" id="qtyprod1" value="" class="form-control" readonly>
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
          <p id="free" class="m-3" style="font-size:16px;"></p>
          <div class="d-flex justify-content-center invisible spin">
            <strong style="margin-right:15px;">Подождите,идет перемещение...</strong>
            <div class="spinner-border" role="status"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
            <button type="button" class="btn btn-primary save">Переместить</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
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
    var cell,qty,name;
    $('tr').click(function(){
       name = $(this).find('#name_prod').text().trim();
       cell = $(this).find('#cell').text().trim();
       qty = $(this).find('#qty').text().trim();
      $('#nameprod1').prop('value',name);
      $('#qtyprod1').prop('value',qty);
      $('#fromcell').prop('value',cell);
      $('#modal').modal('show');
      $('#intocell').change(function(){
        var incell = $('#intocell option:selected').text().trim();
        if(incell == cell){
          $('.save').prop('disabled',true);
          swal({
            title: "Перемещение товаров",
            text: "Вы не можете переместить товаров в ту же ячейку, в которой он лежит!",
            icon: "error",
          });
        }
        else {
          $('.save').prop('disabled',false);
        }
        $.ajax({
          url: "/site/checkcells",
          type: "POST",
          data: ({incell:incell}),
          dataType: "html",
          success: function(data){
            $('#free').text("В данную ячейку можно положить еще " + data + " товаров.");
          },
        });
      });
      $('.save').click(function(){
        var incell = $('#intocell option:selected').text().trim();
        $.ajax({
          url: "/site/movement",
          type: "POST",
          data: ({name:name,cell:cell,qty:qty,incell:incell}),
          dataType: "html",
          beforeSend: function(){
            $('.spin').removeClass('invisible');
          },
          success: function(data){
            if(data == "ok"){

              $('.spin').addClass('invisible');
              $('#free').text("");
              swal({
                title:"Перемещение товаров",
                text: "Книга" + name + " успешно перемещена из ячейки " + cell + " в ячейку "+ incell,
                icon: "success",
                button: "Продолжить",
              })
              .then(function(){
                window.location.replace("/site/infoproducts");
              });
            }
            else {
              alert('bad');
            }
          }
        });
      });
    });
  });
</script>
