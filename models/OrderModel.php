<?php

/**
 * OrderModel class для работы с заказами
 */
class OrderModel
{
	/**
	 * Покупка товара
	 * @param int $id 
	 * @return boolean
	 */
	public static function addProduct($id, $user_id)
	{
		$id = intval($id);
		
		$db = DB::getConnection();

		$sql = 'SELECT id FROM order_user WHERE user_id = :user_id AND product_id = :product_id';
		
		$result = $db->prepare($sql);
    $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $result->bindParam(':product_id', $id, PDO::PARAM_INT);
    $result->execute();

    $order = $result->fetch();

    if ($order) {
			$sql = 'UPDATE order_user SET date_update = NOW(), count = count + 1 WHERE id = :id';

			$result = $db->prepare($sql);
			$result->bindParam(':id', $order['id'], PDO::PARAM_INT);
			
			if($result->execute()) {
				$sql = 'UPDATE product SET date_update = NOW(), quantity = quantity - 1 WHERE id = :id';

				$result = $db->prepare($sql);
				$result->bindParam(':id', $id, PDO::PARAM_INT);
				
				if($result->execute()) {
					return true;
				}
			}
    } else {
			$sql = 'INSERT INTO order_user '
				.'(user_id, product_id, count, date_update) '
				.'VALUES (:user_id, :product_id, 1, NOW())';
			
			$result = $db->prepare($sql);
			$result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$result->bindParam(':product_id', $id,  PDO::PARAM_INT);
			
			if($result->execute()) {
				$sql = 'UPDATE product SET date_update = NOW(), quantity = quantity - 1 WHERE id = :id';

				$result = $db->prepare($sql);
				$result->bindParam(':id', $id, PDO::PARAM_INT);
				
				if($result->execute()) {
					return true;
				}
			}
		}
    return false;
	}
	
	/**
	 * Список покупок
	 * @param int $user_id 
	 * @return array
	 */
	public static function getOrdersById($user_id)
	{
		$db = DB::getConnection();

		$sql = 'SELECT o.id AS id, o.product_id AS product_id, o.count AS count, p.name AS name, p.price AS price, o.date_update AS date_update FROM order_user AS o, product AS p WHERE o.user_id = :user_id AND o.product_id = p.id';
		
		$result = $db->prepare($sql);
    $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();

		$arList = array();
		
		while ($row = $result->fetch()) {
			$arList[] = $row;
		}
		return $arList;
	}
	
	/**
	 * Список покупок
	 * @param int $user_id 
	 * @return array
	 */
	public static function getOrdersSellById($user_id)
	{
		$db = DB::getConnection();

		$sql = 'SELECT o.id AS id, o.product_id AS product_id, o.count AS count, p.name AS name, p.price AS price, o.date_update AS date_update '
			.'FROM order_user AS o, product AS p WHERE p.user_id = :user_id AND o.product_id = p.id';
		
		$result = $db->prepare($sql);
    $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();

		$arList = array();
		
		while ($row = $result->fetch()) {
			$arList[] = $row;
		}
		return $arList;
	}
	
	/**
	 * Данные продавца
	 * @param int $product_id 
	 * @return array
	 */
	public static function getContact($product_id)
	{
		$db = DB::getConnection();

		$sql = 'SELECT * FROM product AS p, user AS u WHERE p.id = :product_id AND p.user_id = u.id';
		
		$result = $db->prepare($sql);
    $result->bindParam(':product_id', $product_id, PDO::PARAM_INT);
		$result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();
		
		return $result->fetch();
	}
	
	/**
	 * Данные покупателя
	 * @param int $product_id 
	 * @return array
	 */
	public static function getContactSell($product_id)
	{
		$db = DB::getConnection();

		$sql = 'SELECT * FROM order_user AS o, user AS u WHERE o.product_id = :product_id AND o.user_id = u.id';
		
		$result = $db->prepare($sql);
    $result->bindParam(':product_id', $product_id, PDO::PARAM_INT);
		$result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();
		
		return $result->fetch();
	}
}