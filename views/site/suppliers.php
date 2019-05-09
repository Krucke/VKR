<?php
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Html;

$this->title = 'Поставщики';
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<!-- <form class="form" action="/site/suppliers" method="post">
  <button type="submit" name="save" class="btn btn-success">Save</button>
</form> -->
<div class="row justify-content-center">
  <h2 class="w-100 text-center mt-3">Поставщики</h2>
  <form action="" class="col-12" id="form">
    <input type="text" name="referal" value="" class="form-control col-md-12 who mb-3 mt-3" id="textsearch" autocomplete="off" placeholder="Поиск по названию поставщика...">
  </form>
  <?php
    foreach ($suppliers as $sup):
  ?>
  <div class="card w-100 mb-4 mt-2">
    <div class="row">
      <div class="col-md-2 d-flex align-items-center">
        <img src="<?=$sup->img_sup?>" class="card-img" alt="Фото профиля">
      </div>
      <div class="col-md-10">
        <div class="card-body">
          <h5 class="card-title"><?=$sup->name_sup?></h5>
          <p class="card-text text-justify"><?=mb_substr($sup->description_sup,0,190)."..."?></p>
          <p class="card-text"><?=$sup->adress_sup?></p>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>
<script>
  $(document).ready(function(){
    $(".who").keyup(function(){
      _this = this;

      $.each($('.card'),function(){
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
<?php

if(isset($_POST['save'])){
  \PhpOffice\PhpWord \ Settings :: setCompatibility (false);
  \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
  \PhpOffice\PhpWord\Settings :: setZipClass (\PhpOffice\PhpWord\Settings :: PCLZIP);
  $worddoc = new \PhpOffice\PhpWord\PhpWord();
  $worddoc->setDefaultFontName('Times New Roman');
  $worddoc->setDefaultFontSize(12);

  $properties = $worddoc->getDocInfo();

  $properties->setCreator('da');
  $properties->setCompany('ООО');
  $properties->setTitle('Заголовок');
  $properties->setDescription('My description');
  $properties->setCategory('My category');
  $properties->setLastModifiedBy('das');
  $properties->setSubject('My subject');
  $properties->setKeywords('my, key, word');

  $section = $worddoc->addSection();

  $tableStyle = [
    "borderColor" => '000000',
    "borderSize" => 3,
    "align" => 'center',
    "textAlignment" => 'center'
  ];
  $table = $section->addTable($tableStyle);

  $table->addRow();
  $cellId = $table->addCell();
  $cellId->addText('Id');
  $cellName = $table->addCell();
  $cellName->addText('Name_sup');
  $cellDesc = $table->addCell();
  $cellDesc->addText('Description');

  for ($j=0; $j < count($suppliers); $j++) {
    $table->addRow();
    $table->addCell()->addText($suppliers[$j]['id_sup']);
    $table->addCell()->addText($suppliers[$j]['name_sup']);
    $table->addCell()->addText($suppliers[$j]['description_sup']);
  }
  $filename = "Информация о поставщиках на ".date('Y.m.d').".docx";
  header("Content-Description: File Transfer");
  header('Content-Disposition: attachment; filename="'.$filename.'"');
  header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
  header('Content-Transfer-Encoding: binary');
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  header('Expires: 0');
  \PhpOffice\PhpWord\Settings::setCompatibility(false);
  $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($worddoc, 'Word2007');
  ob_clean();
  $xmlWriter->save("php://output");
  exit;
  // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($worddoc, 'Word2007');
  // $objWriter->save('doc'.date('Y-m-d').'.docx');
}
?>
