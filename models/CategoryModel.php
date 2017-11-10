<?php

/**
 * CategoryModel class для работы с пользователями
 */
class CategoryModel
{
  /**
	 * Возвращает массив категорий
	 * @return array 
	 */
	public static function getCategoriesList()
	{
		$db = DB::getConnection();

		$result = $db->query('SELECT id, name FROM category ORDER BY sort, name ASC');

		$arList = array();
		
		while ($row = $result->fetch()) {
			$arList[] = array(
				'id' => $row['id'],
				'name' => $row['name']
			);
		}
		return $arList;
	}
}