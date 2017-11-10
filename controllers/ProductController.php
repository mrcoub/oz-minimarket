<?php
/**
 * ProductController
 */
 
class ProductController
{
	// Action для главной страницы товаров в профиле
	public function actionCreatProductAccount()
	{
		if(!AccountModel::isAuthorized()) header("Location: /login/");
		
		$arProductsList = ProductModel::getProductsList(AccountModel::getId());
		
		// Подключение вида
    require_once(ROOT.'/views/account/product/create.php');
    return true;
	}
	
	// Action для главной страницы товаров в профиле
	public function actionIndexAccount()
	{
		if(!AccountModel::isAuthorized()) header("Location: /login/");
		
		$arProductsList = ProductModel::getProductsList(AccountModel::getId());
		
		// Подключение вида
    require_once(ROOT.'/views/account/product/index.php');
    return true;
	}
	
	// Action для главной страницы товара
	public function actionIndex($id)
	{
		$arCategories = CategoryModel::getCategoriesList();
		
		$arProduct = ProductModel::getProductId($id);
		
		// Подключение вида
    require_once(ROOT.'/views/product/index.php');
    return true;
	}
}