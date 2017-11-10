<?php
/**
 * AccountProductController
 */
 
class AccountProductController
{
	// Action для страницы создания товара
	public function actionCreate()
	{
		if(!AccountModel::isAuthorized()) header("Location: /login/");
		
		$arCategoriesList = CategoryModel::getCategoriesList();
		
		if (isset($_POST['submit'])) {
			$options = array(
				'name' => $_POST['name'],
				'description' => $_POST['description'],
				'category_id' => $_POST['category'],
				'price' => $_POST['price'],
				'quantity' => $_POST['quantity'],
				'user_id' => AccountModel::getId()
			);
			$errors = array();
			
			if (
				(!isset($options['name']) || empty($options['name']))
				|| (!isset($options['category_id']) || empty($options['category_id']))
				|| (!is_numeric($options['price']) || !isset($options['price']) || empty($options['price']))
				|| (!is_numeric($options['quantity']) || !isset($options['quantity']) || empty($options['quantity']))
				) {
				$errors[] = 'Заполните обязательные поля.';
			}
			
			if (is_uploaded_file($_FILES['image']['tmp_name'])) {
				$arTypeImg = array('image/jpeg', 'image/png', 'image/gif');
				
				if(!in_array($_FILES['image']['type'], $arTypeImg)) {
					$errors[] = 'Доступно для загрузки изображение в фаормате png, jpg, gif.';
				}
				
				if ($_FILES['image']['size'] > 2000000) {
					$errors[] = 'Раземр файла не должен превышать 2Мб.';
				}
			}
			
			if (empty($errors)) {
				if($options['price'] < 0) $options['price'] = 0;
			
				if($options['quantity'] < 1) $options['quantity'] = 1;
				elseif($options['quantity'] > 100) $options['quantity'] = 100;
			}
			
			if (empty($errors)) {
				$id = ProductModel::create($options);
				
				if (is_uploaded_file($_FILES['image']['tmp_name'])) {
						move_uploaded_file($_FILES['image']['tmp_name'], ROOT. "/upload/images/product/{$id}.jpg");
				}
				
				header("Location: /account/product/");
			}
		}
		
		// Подключение вида
    require_once(ROOT.'/views/account/product/create.php');
    return true;
	}
	
	// Action для страницы изменения товара
	public function actionUpdate($id)
	{
		if(!AccountModel::isAuthorized()) header("Location: /login/");
		
		$arCategoriesList = CategoryModel::getCategoriesList();
		
		$arProduct = ProductModel::getProductById($id, AccountModel::getId());
		
		if (isset($_POST['submit'])) {
			$options = array(
				'name' => $_POST['name'],
				'description' => $_POST['description'],
				'category_id' => $_POST['category'],
				'price' => $_POST['price'],
				'quantity' => $_POST['quantity'],
				'user_id' => AccountModel::getId()
			);
			$errors = array();
			$res = false;
			$checkDeleteImg = (isset($_POST['delete_image']) && !empty($_POST['delete_image'])? true: false);
			
			if (
				(!isset($options['name']) || empty($options['name']))
				|| (!isset($options['category_id']) || empty($options['category_id']))
				|| (!is_numeric($options['price']) || !isset($options['price']) || empty($options['price']))
				|| (!is_numeric($options['quantity']) || !isset($options['quantity']) || empty($options['quantity']))
				) {
				$errors[] = 'Заполните обязательные поля.';
			}
			
			if (is_uploaded_file($_FILES['image']['tmp_name'])) {
				$arTypeImg = array('image/jpeg', 'image/png', 'image/gif');
				
				if(!in_array($_FILES['image']['type'], $arTypeImg)) {
					$errors[] = 'Доступно для загрузки изображение в фаормате png, jpg, gif.';
				}
				
				if ($_FILES['image']['size'] > 2000000) {
					$errors[] = 'Раземр файла не должен превышать 2Мб.';
				}
			}
			
			if (empty($errors)) {
				if($options['price'] < 0) $options['price'] = 0;
			
				if($options['quantity'] < 1) $options['quantity'] = 1;
				elseif($options['quantity'] > 100) $options['quantity'] = 100;
			}
			
			if (empty($errors)) {
				if ($res = ProductModel::updateProductById($id, $options, AccountModel::getId())) {
					if($checkDeleteImg && file_exists(ROOT.ProductModel::getImage($id))&& stripos(ProductModel::getImage($id), 'noimage') === false) {
						unlink(ROOT.ProductModel::getImage($id));
					}
					
					if (is_uploaded_file($_FILES['image']['tmp_name'])) {
							move_uploaded_file($_FILES['image']['tmp_name'], ROOT. "/upload/images/product/{$id}.jpg");
					}
				} else {
					$errors[] = 'Произошла ошибка при обновлении товара';
				}
			}
		}
		
		// Подключение вида
    require_once(ROOT.'/views/account/product/update.php');
    return true;
	}
	
	// Action для удаления продукта
	public function actionDelete($id)
	{
		if(!AccountModel::isAuthorized()) header("Location: /login/");

		ProductModel::deleteProductById($id, AccountModel::getId());
		
		header("Location: /account/product/");
	}
	
	// Action для главной страницы товаров в профиле
	public function actionIndex()
	{
		if(!AccountModel::isAuthorized()) header("Location: /login/");
		
		$arProductsList = ProductModel::getProductsListAccount(AccountModel::getId());
		
		// Подключение вида
    require_once(ROOT.'/views/account/product/index.php');
    return true;
	}
	
	// Action для страницы с проданными товарами
	public function actionSell()
	{
		if(!AccountModel::isAuthorized()) header("Location: /login/");
    
		$arOrdersSell = OrderModel::getOrdersSellById(AccountModel::getId());
		
		// Подключение вида
    require_once(ROOT . '/views/account/product/sell.php');
    return true;
	}
}