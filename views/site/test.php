<?php
use yii\helpers\ArrayHelper;
?>
<form class="" action="" method="post">
  <input type="text" name="inp" value="" class="form-control">
  <button type="submit" name="button" class="btn btn-primary">Add</button>
  <button type="submit" name="delete">delete</button>
</form>
<?php
$session = Yii::$app->session;
$session['ses'];
if (isset($_POST['button'])) {
  $newarr[$_POST['inp']] = array('name_prod' => $_POST['inp'],'qty' => $_POST['inp']);
  $sesarr = $session['ses'];
  $sesarr[] = $newarr;
  $_SESSION['ses'] = $sesarr;
  // unset($_SESSION['ses']);
  // $sesArr = $ses['ses'];
  // $sesArr[] = $newarr;
  // $ses['ses'] = $sesArr;
  // foreach ($_SESSION['ses'] as $key => $value) {
  //   echo $value['name_prod']."<br />";
  // }
}
if(isset($_POST['delete'])){
  unset($session['ses']);
}
if(isset($session['ses'])) print_r($_SESSION['ses']);
?>
