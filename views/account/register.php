<?php include(ROOT.'/views/include/header.php'); ?>
<div class="section">
  <h5>Регистрация</h5>
  <div class="row">
    <?php if ($res): ?>
			<div class="col s12 alert">
				<div class="green lighten-4 white-text alert-text">
					Вы зарегистрированы!
				</div>
			</div>
    <?php else: ?>
      <form class="col s12" action="" method="post">
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
            <input id="fio" type="text" name="fio">
            <label for="fio">ФИО *</label>
          </div>
          <div class="input-field col s12">
            <input id="email" type="email" name="email">
            <label for="email">Email *</label>
          </div>
          <div class="input-field col s12">
            <input id="phone" type="text" name="phone">
            <label for="phone">Телефон</label>
          </div>
          <div class="input-field col s12">
            <input id="password" type="password" name="password">
            <label for="password">Пароль *</label>
          </div>
          <div class="input-field col s12">
            <input id="confirm_password" type="password" name="confirm_password">
            <label for="confirm_password">Повторить пароль *</label>
          </div>
					<div class="col s12">
						* - обязательные поля
					</div>
        </div>
        <div class="row">
          <div class="col s12">
            <button class="btn waves-effect waves-light" type="submit" name="submit">Регистрация</button>
            <a href="/login/" class="waves-effect waves-teal btn-flat">Авторизироваться</a>
          </div>
        </div>
      </form>
	<?php endif; ?>
  </div>
</div>
<?php include(ROOT.'/views/include/footer.php'); ?>