<?php

/**
 * OrderController
 */
 
class OrderController
{
	/**
	 * Action для покупки товара
	 * @param integer $id
	 * @return boolean
	 */
	public function actionAddAjax($id)
	{
			return OrderModel::addProduct($id, AccountModel::getId());
	}
	
	/**
	 * Action получения данных о продавце
	 * @param integer $product_id
	 * @param data
	 */
	public function actionGetContact($product_id)
	{
			echo json_encode(OrderModel::getContact($product_id));
			return true;
	}
	
	/**
	 * Action получения данных о покупателе
	 * @param integer $product_id
	 * @param data
	 */
	public function actionGetContactSell($product_id)
	{
			echo json_encode(OrderModel::getContactSell($product_id));
			return true;
	}
}