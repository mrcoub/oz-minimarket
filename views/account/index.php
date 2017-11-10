<?php include(ROOT.'/views/include/header.php'); ?>

<div class="menu-account">
  <a href="/account/" class="waves-effect waves-light btn disabled">Купленные товары</a>
  <a href="/account/product/" class="waves-effect waves-light btn">Товары</a>
  <a href="/account/product/sell/" class="waves-effect waves-light btn">Проданные Товары</a>
  <a href="/account/edit/" class="waves-effect waves-light btn">Изменить профиль</a>
</div>

<div class="section">
	<?php if (count($arOrders) < 1): ?>
		<h5>Купленные товары отсутствуют</h5>
	<?php else: ?>
		<h5>Список купленных товаров</h5>
		<table class="striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Название товара</th>
					<th>Цена</th>
					<th>Количество</th>
					<th>Дата последнего изменения</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($arOrders as $order): ?>
				<tr>
					<td><?php echo $order['id']; ?></td>
					<td><?php echo htmlspecialchars($order['name']); ?></td>
					<td><?php echo $order['price']; ?> руб.</td>
					<td><?php echo $order['count']; ?></td>
					<td><?php echo $order['date_update']; ?></td>
					<td><a href="#" class="contact waves-effect waves-light btn blue" title="О продавце" data-id="<?php echo $order['product_id']; ?>"><i class="material-icons">account_box</i></a></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
</div>
<!-- Modal Structure -->
<div id="modal" class="modal bottom-sheet open" style="z-index: 1007; display: none; opacity: 1; bottom: 0px;">
	<div class="modal-content">
		<h4>Контакты покупателя</h4>
		<ul class="collection">
			<li class="collection-item">
				<span class="title">Title</span>
				<p class="email">First Line</p>
				<p class="phone">Last Line</p>
			</li>
		</ul>
	</div>
</div>
<script>
	$(function() {
		$("a.contact").click(function () {
			var id = $(this).attr("data-id");
			$.post("/order/getContact/"+id, {}, function (data) {
				$('#modal').modal();
				var dataJSON = JSON.parse(data);
				$('#modal .title').html('ФИО: '+dataJSON.fio);
				$('#modal .email').html('EMail: '+dataJSON.email);
				$('#modal .phone').html('Телефон: '+dataJSON.phone);
				$('#modal').modal('open');
			});
			return false;
		});
	});
</script>
<?php include(ROOT.'/views/include/footer.php'); ?>