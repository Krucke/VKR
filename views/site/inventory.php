<?php

$this->title = "Создание акта о проведении инвентаризации"
?>

<h2 class="text-center mt-4 mb-3">Создание акта о проведении инвентаризации</h2>
<form class="" action="/site/inv" method="post">
  <label for="base" class="mb-3">Основания для проведения инвентаризации</label>
  <select class="form-control mb-3" name="base" id="base" placeholder="Основания для проведения инвентаризации">
    <option value="">Приказ</option>
    <option value="">Поставновление</option>
    <option value="">Распоряжение</option>
  </select>
  <label for="face" class="mb-3">Ответсвенное лицо</label>
  <select class="form-control mb-3" name="face" id="face" value="" placeholder="Ответственное лицо" required>
    <?php foreach ($empl as $emp): ?>
      <option value="<?=$emp['id_emp']?>"><?=$emp['lastname_emp']." ".$emp['firstname_emp']." ".$emp['otch_emp']?></option>
    <?php endforeach; ?>
  </select>
  <label for="date" class="mb-3">Дата проведения инвентаризации</label>
  <input type="date" name="date" id="date" value="" placeholder="Дата проведения инвентаризации" class="form-control mb-3" required>
  <button type="submit" name="save" class="btn btn-primary button__dark mt-3 float-right">Создать акт</button>
</form>
