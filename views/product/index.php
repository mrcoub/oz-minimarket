<?php include(ROOT.'/views/include/header.php'); ?>

<div class="row">
	<div class="col s3">
		<h5>Каталог</h5>
		<div class="collection">
			<?php if (!empty($arCategories)) foreach ($arCategories as $category): ?>
				<a href="/category/<?php echo $category['id']; ?>/" class="collection-item<?php echo ($category['id'] == $arProduct['category_id']? ' active': ''); ?>">
					<?php echo htmlspecialchars($category['name']); ?>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="col s9">
		<?php if (empty($arProduct)): ?>
			<div class="row">
				<div class="col s12 alert">
					<div class="materialize-red lighten-4 white-text alert-text">
						Данный товар не найден.
					</div>
				</div>
			</div>
		<?php else: ?>
			<h5><?php echo htmlspecialchars($arProduct['name']); ?></h5>
			<div class="row">
					<div class="col s12">
						<div class="card horizontal product-card">
							<div href="/product/<?php echo $arProduct['id']; ?>/" class="card-image">
								<img src="<?php echo ProductModel::getImage($arProduct['id']); ?>">
							</div>
							<div class="card-stacked">
								<div class="card-content">
									<?php if (!empty($arProduct['description'])): ?>
										<span class="card-title activator grey-text text-darken-4">Описание</span>
										<p><?php echo htmlspecialchars($arProduct['description']); ?></p>
									<?php endif; ?>
								</div>
								<div class="card-action">
									<b>Цена:</b> <?php echo $arProduct['price']; ?> руб.</br>
									<b>В наличии:</b> <?php echo $arProduct['quantity']; ?>
								</div>
								<div class="card-action">
									<a class="add-order waves-effect waves-light btn<?php echo (!AccountModel::isAuthorized() || AccountModel::getId() == $arProduct['user_id']? ' disabled': ''); ?>" data-id="<?php echo $arProduct['id']; ?>">КУПИТЬ</a>
								</div>
							</div>
						</div>
					</div>
			</div>
		<?php endif; ?>
	</div>
</div>

<script>
	$(function() {
		$(".add-order").click(function () {
			var id = $(this).attr("data-id");
			$.post("/order/addAjax/"+id, {}, function () {
					location.reload()
			});
			return false;
		});
	});
</script>

<?php include(ROOT.'/views/include/footer.php'); ?>