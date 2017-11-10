<?php include(ROOT.'/views/include/header.php'); ?>

<div class="menu-account">
  <a href="/account/" class="waves-effect waves-light btn">Купленные товары</a>
  <a href="/account/product/" class="waves-effect waves-light btn disabled">Товары</a>
  <a href="/account/product/sell/" class="waves-effect waves-light btn">Проданные Товары</a>
  <a href="/account/edit/" class="waves-effect waves-light btn">Изменить профиль</a>
	<div class="fixed-action-btn">
		<a href="/account/product/create/" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
	</div>
</div>

<div class="section">
	<?php if (count($arProductsList) < 1): ?>
		<h5>Товары для продажи отсутствуют</h5>
	<?php else: ?>
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
		<h5>Список товаров выставленных на продажу</h5>
		<table class="striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Название</th>
					<th>Цена</th>
					<th>Количество в продаже</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($arProductsList as $item): ?>
				<tr>
					<td><?php echo $item['id']; ?></td>
					<td><?php echo htmlspecialchars($item['name']); ?></td>
					<td><?php echo $item['price']; ?> руб.</td>
					<td><?php echo $item['quantity']; ?></td>
					<td><a href="/account/product/update/<?php echo $item['id']; ?>/" class="waves-effect waves-light btn green"><i class="material-icons">edit</i></a></td>
					<td><a onclick="if(!confirm('Вы уверены в удалении товара?')) return false;" href="/account/product/delete/<?php echo $item['id']; ?>/" class="waves-effect waves-light btn red"><i class="material-icons">delete</i></a></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
</div>

<?php include(ROOT.'/views/include/footer.php'); ?>