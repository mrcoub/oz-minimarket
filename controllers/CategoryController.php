<?php
/**
 * CategoryController
 */
 
class CategoryController
{
	/**
	 * Action для страницы категории товаров
	 */
	public function actionIndex($categoryId, $order = 'last', $page = 1)
	{
		$arSort = array(
			'last' => 'По умолчанию', 
			'name' => 'По названию', 
			'price' => 'По цене', 
			'price_desc' => 'По цене (убывание)'
		);
		
		$arCategories = CategoryModel::getCategoriesList();

		$categoryProducts = ProductModel::getProducts(ProductModel::SHOW_BY_DEFAULT, $categoryId, $order, $page);
		
		$totalProducts = ProductModel::getTotalProductsInCategory($categoryId);
		
		$total = intval((intval($totalProducts) - 1) / ProductModel::SHOW_BY_DEFAULT) + 1;
		
		
		
		// Подключаем вид
		require_once(ROOT . '/views/category/index.php');
		return true;
	}
}