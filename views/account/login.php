<?php include(ROOT.'/views/include/header.php'); ?>
<div class="section">
  <h5>Авторизация</h5>
  <div class="row">
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
        <div class="input-field col s6">
          <input id="last_name" type="email" name="email">
          <label for="last_name">Email</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="password" name="password">
          <label for="last_name">Пароль</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <button class="btn waves-effect waves-light" type="submit" name="submit">Войти</button>
		  <a href="/register/" class="waves-effect waves-teal btn-flat">Зарегистрироваться</a>
        </div>
      </div>
    </form>
  </div>
</div>
<?php include(ROOT.'/views/include/footer.php'); ?>