<?php include(ROOT.'/views/include/header.php'); ?>

<div class="row">
	<div class="col s3">
		<h5>Каталог</h5>
		<div class="collection">
			<?php if (!empty($arCategories)) foreach ($arCategories as $category): ?>
				<a href="/category/<?php echo $category['id']; ?>/" class="collection-item<?php echo ($category['id'] == $categoryId? ' active': ''); ?>">
					<?php echo htmlspecialchars($category['name']); ?>
				</a>
			<?php endforeach; ?>
		</div>
		<h5>Сортировка</h5>
		<div class="collection">
			<?php if (!empty($arSort)) foreach ($arSort as $key => $item): ?>
				<a href="/category/<?php echo $categoryId; ?>/order-<?php echo $key; ?>/<?php echo ($page != 1? "page-{$page}/": ''); ?>" class="collection-item<?php echo ($key == $order? ' active': ''); ?>">
					<?php echo $item; ?>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="col s9">
		<h5>Товары</h5>
		<div class="row">
			<?php if (!empty($categoryProducts)) foreach ($categoryProducts as $product): ?>
				<div class="col s12">
					<div class="card horizontal">
						<a href="/product/<?php echo $product['id']; ?>/" class="card-image">
							<img src="<?php echo ProductModel::getImage($product['id']); ?>">
						</a>
						<div class="card-stacked">
							<div class="card-content">
								<a href="/product/<?php echo $product['id']; ?>/" class="card-title activator grey-text text-darken-4"><?php echo htmlspecialchars($product['name']); ?></a>
								<?php if (!empty($product['description'])): ?>
									<p><?php echo htmlspecialchars($product['description']); ?></p>
								<?php endif; ?>
							</div>
							<div class="card-action">
								<b>Цена:</b> <?php echo $product['price']; ?> руб.
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php if ($total > 1): ?>
		<div class="row">
			<div class="col s12">
				<ul class="pagination">
					<?php
						if($page != 1) {
							$nav[] = '<li class="waves-effect"><a href="/category/'.$categoryId.'/order-'.$order.'/page-'.($page - 1).'/"><i class="material-icons">chevron_left</i></a></li>';
						} else {
							$nav[] = '<li class="disabled"><a href="/category/'.$categoryId.'/order-'.$order.'/page-q/"><i class="material-icons">chevron_left</i></a></li>';
						}
						
						if($page - 2 > 0) {
							$nav[] = '<li class="waves-effect"><a href="/category/'.$categoryId.'/order-'.$order.'/page-'.($page - 2).'/">'.($page - 2).'</a></li>';
						}
						
						if($page - 1 > 0) {
							$nav[] = '<li class="waves-effect"><a href="/category/'.$categoryId.'/order-'.$order.'/page-'.($page - 1).'/">'.($page - 1).'</a></li>';
						}
						
						$nav[] = '<li class="active"><a href="/category/'.$categoryId.'/order-'.$order.'/page-'.($page).'/">'.$page.'</a></li>';
						
						if($page + 1 <= $total) {
							$nav[] = '<li class="waves-effect"><a href="/category/'.$categoryId.'/order-'.$order.'/page-'.($page + 1).'/">'.($page + 1).'</a></li>';
						}
						
						if($page + 2 <= $total) {
							$nav[] = '<li class="waves-effect"><a href="/category/'.$categoryId.'/order-'.$order.'/page-'.($page + 2).'/">'.($page + 2).'</a></li>';
						}
						
						if($page != $total) {
							$nav[] = '<li class="waves-effect"><a href="/category/'.$categoryId.'/order-'.$order.'/page-'.($page + 1).'/"><i class="material-icons">chevron_right</i></a></li>';
						} else {
							$nav[] = '<li class="disabled"><a href="/category/'.$categoryId.'/order-'.$order.'/page-'.($total).'/"><i class="material-icons">chevron_right</i></a></li>';
						}
						
						foreach($nav as $item)
								echo $item;
					?>
				</ul>
			</div>
		</div>
	<?php endif; ?>
</div>

<?php include(ROOT.'/views/include/footer.php'); ?>