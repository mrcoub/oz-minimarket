<?php

/**
 * ProductModel class для работы с пользователями
 */
class ProductModel
{
	const SHOW_BY_DEFAULT = 6;
	
  /**
   * Добавляет новый товар
   * @param array $options
   * @return mixed: (integer id product / false) 
   */
  public static function create($options)
  {
		$db = DB::getConnection();
		
		$sql = 'INSERT INTO product '
			.'(category_id, name, date_create, date_update, price, quantity, description, user_id) '
			.'VALUES (:category_id, :name, NOW(), NOW(), :price, :quantity, :description, :user_id)';
		
		$result = $db->prepare($sql);
		$result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
		$result->bindParam(':name', $options['name'], PDO::PARAM_STR, 255);
		$result->bindParam(':price', $options['price'], PDO::PARAM_STR);
		$result->bindParam(':quantity', $options['quantity'], PDO::PARAM_INT, 3);
		$result->bindParam(':description', $options['description'], PDO::PARAM_STR);
		$result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
		
		if ($result->execute()) {
			return $db->lastInsertId();
		}
		
		return false;
  }
	
	/**
	 * Возвращает товар по id
	 * @param integer $id
	 * @param integer $user_id - для проверки
	 * @return array
	 */
	public static function getProductById($id, $user_id)
	{
		$db = DB::getConnection();

		$sql = 'SELECT * FROM product WHERE id = :id AND user_id = :user_id';

		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();
		
		return $result->fetch();
	}
	
	/**
	 * Возвращает путь к изображению
	 * @param integer $id
	 * @return string
	 */
	public static function getImage($id)
	{
			$noImage = 'noimage.png';

			$path = '/upload/images/product/';

			$pathToProductImage = $path.$id.'.jpg';

			if (file_exists(ROOT.$pathToProductImage)) {
					return $pathToProductImage;
			}

			return $path.$noImage;
	}
	
	/**
	 * Обновляет информацию товара с заданным id
	 * @param integer $id
	 * @param array $options
	 * @param integer $user_id - для проверки
	 * @return boolean
	 */
	public static function updateProductById($id, $options, $user_id)
	{
		$db = DB::getConnection();

		$sql = 'UPDATE product SET category_id = :category_id, name = :name, '
			.'date_update = NOW(), price = :price, quantity = :quantity, '
			.'description = :description WHERE id = :id AND user_id = :user_id';

		$result = $db->prepare($sql);
		$result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
		$result->bindParam(':name', $options['name'], PDO::PARAM_STR, 255);
		$result->bindParam(':price', $options['price'], PDO::PARAM_STR);
		$result->bindParam(':quantity', $options['quantity'], PDO::PARAM_INT, 3);
		$result->bindParam(':description', $options['description'], PDO::PARAM_STR);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
		
		return $result->execute();
	}
	
	/**
	 * Удаляем товар с заданным id
	 * @param integer $id
	 * @param integer $user_id - для проверки
	 * @return boolean
	 */
	public static function deleteProductById($id, $user_id)
	{
		$db = DB::getConnection();

		if(file_exists(ROOT.self::getImage($id)) && stripos(self::getImage($id), 'noimage') === false) {
			unlink(ROOT.self::getImage($id));
		}
		
		$sql = 'DELETE FROM product WHERE id = :id AND user_id = :user_id';

		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		
		return $result->execute();
	}
	
	/**
	 * Возвращает массив товаров
	 * @return array 
	 */
	public static function getProductsListAccount($id)
	{
		$db = DB::getConnection();

		$sql = 'SELECT id, name, price, quantity FROM product '
			.'WHERE user_id = :user_id ORDER BY date_create ASC';
		
		$result = $db->prepare($sql);
		$result->bindParam(':user_id', $id, PDO::PARAM_INT);
		$result->execute();

		$arList = array();
		
		while ($row = $result->fetch()) {
			$arList[] = array(
				'id' => $row['id'],
				'name' => $row['name'],
				'price' => $row['price'],
				'quantity' => $row['quantity']
			);
		}
		return $arList;
	}
	
	/**
	 * Возвращает массив товаров
	 * @param type $count
	 * @param type $page
	 * @return array
	 */
	public static function getProducts($count = self::SHOW_BY_DEFAULT, $categoryId = false, $order = 'last', $page = 1)
	{
		$db = DB::getConnection();

		$limit = $count;
		$offset = ($page - 1) * $limit;
		
		$sql = 'SELECT id, category_id, name, price, quantity, description '
			.'FROM product '
			.'WHERE quantity != 0 ';
		
		if ($categoryId !== false) {
			$sql .= 'AND category_id = :category_id ';
		}
		
		switch ($order) {
			case 'price':
				$sql .= 'ORDER BY price ASC ';
				break;
			case 'price_desc':
				$sql .= 'ORDER BY price DESC ';
				break;
			case 'name':
				$sql .= 'ORDER BY name ASC ';
				break;
			default:
				$sql .= 'ORDER BY date_create DESC ';
				break;
		}
		
		$sql .= 'LIMIT :limit OFFSET :offset';

		$result = $db->prepare($sql);
		
		if ($categoryId !== false) {
			$result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
		}
		
		$result->bindParam(':limit', $limit, PDO::PARAM_INT);
		$result->bindParam(':offset', $offset, PDO::PARAM_INT);
		$result->execute();

		$arList = array();
		while ($row = $result->fetch()) {
			$arList[] = array(
				'id' => $row['id'],
				'category_id' => $row['category_id'],
				'name' => $row['name'],
				'price' => $row['price'],
				'quantity' => $row['quantity'],
				'description' => $row['description']
			);
		}
		return $arList;
	}
	
	/**
	 * Возвращаем количество товаров в указанной категории
	 * @param integer $categoryId
	 * @return integer
	 */
	public static function getTotalProductsInCategory($categoryId)
	{
		$db = DB::getConnection();

		$sql = 'SELECT COUNT(id) AS count FROM product WHERE quantity != 0 AND category_id = :category_id';

		$result = $db->prepare($sql);
		$result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);

		$result->execute();

		$row = $result->fetch();
		return $row['count'];
	}
	
	/**
	 * Возвращает товар по id
	 * @param integer $id 
	 * @return array 
	 */
	public static function getProductId($id)
	{
		$db = DB::getConnection();

		$sql = 'SELECT * FROM product WHERE id = :id';

		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();
		
		return $result->fetch();
	}
}