<?php include(ROOT.'/views/include/header.php'); ?>

<div class="row">
	<div class="col s3">
		<h5>Каталог</h5>
		<div class="collection">
			<?php if (!empty($arCategories)) foreach ($arCategories as $category): ?>
				<a href="/category/<?php echo $category['id']; ?>/" class="collection-item">
					<?php echo htmlspecialchars($category['name']); ?>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="col s9">
		<h5>Последние товары</h5>
		<div class="row">
			<?php if (!empty($lastProducts)) foreach ($lastProducts as $product): ?>
				<div class="col s12">
					<div class="card horizontal">
						<a href="/product/<?php echo $product['id']; ?>/" class="card-image">
							<img src="<?php echo ProductModel::getImage($product['id']); ?>">
						</a>
						<div class="card-stacked">
							<div class="card-content">
								<a href="/product/<?php echo $product['id']; ?>/" class="card-title activator grey-text text-darken-4"><?php echo htmlspecialchars($product['name']); ?></a>
								<p><?php echo htmlspecialchars($product['description']); ?></p>
							</div>
							<div class="card-action">
								<?php echo htmlspecialchars($product['price']); ?> руб.
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<?php include(ROOT.'/views/include/footer.php'); ?>