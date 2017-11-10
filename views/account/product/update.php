<?php include(ROOT.'/views/include/header.php'); ?>

<div class="menu-account">
  <a href="/account/" class="waves-effect waves-light btn">Купленные товары</a>
  <a href="/account/product/" class="waves-effect waves-light btn">Товары</a>
  <a href="/account/product/sell/" class="waves-effect waves-light btn">Проданные Товары</a>
  <a href="/account/edit/" class="waves-effect waves-light btn">Изменить профиль</a>
</div>

<div class="section">
  <h5>Изменение товара</h5>
  <div class="row">
    <form class="col s12" action="" method="post" enctype="multipart/form-data">
			<?php if (!empty($res)): ?>
				<div class="row">
					<div class="col s12 alert">
						<div class="green lighten-4 white-text alert-text">
							Товар успешно изменен.
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
          <input id="name" type="text" name="name" data-length="255" value="<?php echo htmlspecialchars($arProduct['name']); ?>">
          <label for="name">Название *</label>
        </div>
        <div class="input-field col s12">
          <textarea id="description" name="description" class="materialize-textarea"><?php echo htmlspecialchars($arProduct['description']); ?></textarea>
          <label for="description">Описание</label>
        </div>
				<div class="input-field col s12">
					<select name="category">
						<?php if (is_array($arCategoriesList)) foreach ($arCategoriesList as $category): ?>
							<option value="<?php echo $category['id']; ?>"<?php echo ($arProduct['category_id'] == $category['id']? 'selected': ''); ?>><?php echo htmlspecialchars($category['name']); ?></option>
						<?php endforeach; ?>
					</select>
					<label>Категория *</label>
				</div>
				<div class="input-field col s12">
          <input id="price" type="number" name="price" step="0.01" value="<?php echo $arProduct['price']; ?>">
          <label for="price">Цена *</label>
        </div>
				<div class="input-field col s12">
          <input id="quantity" type="number" name="quantity" min="1" max="100" value="<?php echo $arProduct['quantity']; ?>">
          <label for="quantity">Количество *</label>
        </div>
				<?php if (stripos(ProductModel::getImage($arProduct['id']), 'noimage') === false): ?>
					<div class="col s12">
						<img class="responsive-img" src="<?php echo ProductModel::getImage($arProduct['id']); ?>" width="200" alt="">
						<input type="checkbox" class="filled-in" id="delete_image" name="delete_image">
						<label for="delete_image">Удалить изображение</label>
					</div>
				<?php endif; ?>
        <div class="file-field input-field col s12">
					<div class="btn">
						<span>Изображение товара</span>
						<input type="file" name="image">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text" placeholder="Формат (png, jpg, gif). Размер файла < 2Мб." value="">
					</div>
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