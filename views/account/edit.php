<?php include(ROOT.'/views/include/header.php'); ?>

<div class="menu-account">
  <a href="/account/" class="waves-effect waves-light btn">Купленные товары</a>
  <a href="/account/product/" class="waves-effect waves-light btn">Товары</a>
  <a href="/account/product/sell/" class="waves-effect waves-light btn">Проданные Товары</a>
  <a href="/account/edit/" class="waves-effect waves-light btn disabled">Изменить профиль</a>
</div>

<div class="section">
  <h5>Изменение профиля</h5>
  <div class="row">
    <form class="col s12" action="" method="post" enctype="multipart/form-data">
			<?php if (!empty($res)): ?>
				<div class="row">
					<div class="col s12 alert">
						<div class="green lighten-4 white-text alert-text">
							Профиль успешно изменен.
						</div>
					</div>
				</div>
			<?php endif; ?>
      <?php if (!empty($errors)): ?>
	      <div class="row">
	  	    <div class="col s12 alert">
            <div class="materialize-red lighten-4 white-text alert-text">
              <?php foreach ($errors as $error): ?>
                <?php echo $error.'</br>'; ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="row">
        <div class="input-field col s12">
          <input id="fio" type="text" name="fio" value="<?php echo htmlspecialchars($arDateUser['fio']); ?>">
          <label for="fio">ФИО *</label>
        </div>
				<div class="input-field col s12">
					<input id="email" type="email" name="email" value="<?php echo htmlspecialchars($arDateUser['email']); ?>">
					<label for="email">Email *</label>
				</div>
				<div class="input-field col s12">
					<input id="phone" type="text" name="phone" value="<?php echo htmlspecialchars($arDateUser['phone']); ?>">
					<label for="phone">Телефон</label>
				</div>
				<div class="input-field col s12">
					<input id="old_password" type="password" name="old_password">
					<label for="old_password">Старый Пароль</label>
				</div>
				<div class="input-field col s12">
					<input id="password" type="password" name="password">
					<label for="password">Новый пароль</label>
				</div>
				<div class="input-field col s12">
					<input id="confirm_password" type="password" name="confirm_password">
					<label for="confirm_password">Повторить новый пароль</label>
				</div>
        <div class="col s12">
          * - обязательные поля
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <button class="btn waves-effect waves-light" type="submit" name="submit">Изменить</button>
          <button class="waves-effect waves-teal btn-flat" type="reset" name="reset">Очистить</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
$(function() {
  $('select[name="category"]').material_select();
  $('input[name="price"]').on('change', function() {
    $(this).val(Math.abs(parseFloat(parseFloat($(this).val()).toFixed(2))));
  });
  $('input[name="quantity"]').on('change', function() {
    if($(this).val() > 100) $(this).val(100);
    else if($(this).val() < 1) $(this).val(1);
  });
});
</script>

<?php include(ROOT.'/views/include/footer.php'); ?>