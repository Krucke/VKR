<form class="" action="" method="post">
  <input type="text" name="inp" value="" class="form-control">
  <button type="submit" name="button" class="btn btn-primary">Add</button>
</form>
<?php
$arraynew = array("10","10");
$sessionmassive = array("1","1");
$sesArraynew = $sessionmassive;
$sesArraynew[] = $arraynew;
$sessionmassive[] = $sesArraynew;
print_r($sessionmassive);
?>
