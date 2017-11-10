<?php

/**
 * HomeController
 */
 
class HomeController
{
	// Action для главной страницы
	public function actionIndex()
	{
		$arCategories = CategoryModel::getCategoriesList();
		
		$lastProducts = ProductModel::getProducts();
		
		// Подключение вида
		require_once(ROOT.'/views/home/index.php');
		return true;
	}
}