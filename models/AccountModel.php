<?php

/**
 * AccountModel class для работы с пользователями
 */
class AccountModel
{
	/**
   * Проверяет поле fio
   * @param string $fio
   * @return boolean (true/false)
   */
  public static function checkFio($fio)
  {
    $arFio = explode(' ', $fio);
    
    if(
      count($arFio) == 3 
      && strlen($arFio[0]) >= 3 
      && strlen($arFio[1]) >= 3 
      && strlen($arFio[2]) >= 3
    ) {
      return true;
    }
    
    return false;
  }
	
	/**
   * Проверяет email
   * @param string $email
   * @return boolean (true/false)
   */
  public static function checkEmail($email)
  {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return true;
    }
    return false;
  }
	
	/**
   * Проверяет пароль. (Не меньше 6 символов)
   * @param string $password
   * @return boolean (true/false)
   */
  public static function checkPassword($password)
  {
    if (strlen($password) >= 6) {
      return true;
    }
    return false;
  }
	
	/**
   * Проверяет номер телефона. (регулярное выражение / паттерн)
   * @param string $phone
   * @return boolean (true/false)
   */
  public static function checkPhone($phone)
  {
		$reg = '#^\+375[(](25|29|33|44)[)][0-9]{3}[-][0-9]{2}[-][0-9]{2}$#i';
		
    if (preg_match($reg, $phone)) {
      return true;
    }
    return false;
  }
	
	/**
   * Сравнивает введенные пароли.
   * @param string $password, string $confirmPassword
   * @return boolean (true/false)
   */
  public static function comparePassword($password, $confirmPassword)
  {
    if ($password === $confirmPassword) {
      return true;
    }
    return false;
  }
	
	/**
   * Проверяем существует ли пользователь с заданными $email и $password
   * @param string $email
   * @param string $password
   * @return mixed (integer id/false)
   */
  public static function checkUserData($email, $password)
  {
    $db = DB::getConnection();

    $sql = 'SELECT * FROM user WHERE email = :email';

    $result = $db->prepare($sql);
    $result->bindParam(':email', $email, PDO::PARAM_INT);
    $result->execute();

    $user = $result->fetch();

    if ($user && password_verify($password, $user['password'])) {
      return $user['id'];
    }
    return false;
  }

  /**
   * Проверяет, свободен ли email для регистрации
   * @param string $email
   * @return boolean (false/true)
   */
  public static function checkEmailExists($email)
  {      
    $db = DB::getConnection();

    $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

    $result = $db->prepare($sql);
    $result->bindParam(':email', $email, PDO::PARAM_STR);
    $result->execute();

    if ($result->fetchColumn())
      return true;
    return false;
  }

  /**
   * Проверяет, подходит ли пароль к учетной записи
   * @param string $old_password
   * @param indeger $id
   * @return boolean (false/true)
   */
  public static function checkOldPassword($old_password, $id)
  {      
    $db = DB::getConnection();

    $sql = 'SELECT * FROM user WHERE id = :id';

    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();

    $user = $result->fetch();

    if ($user && password_verify($old_password, $user['password'])) {
      return true;
    }
    return false;
  }
	
	/**
   * Авторизация
   * @param integer $userId <p>id пользователя</p>
   */
  public static function auth($userId)
  {
    $_SESSION['user'] = $userId;
  }
	
	/**
   * Регистрация пользователя 
   * @param string $fio
   * @param string $email
   * @param string $password
   * @param string $phone
   * @return boolean 
   */
  public static function register($fio, $email, $password, $phone)
  {
    $db = DB::getConnection();

    $sql = 'INSERT INTO user (fio, email, password, phone) '
    .'VALUES (:fio, :email, :password, :phone)';

    $hash = password_hash($password, PASSWORD_BCRYPT);
    
    $result = $db->prepare($sql);
    $result->bindParam(':fio', $fio, PDO::PARAM_STR);
    $result->bindParam(':email', $email, PDO::PARAM_STR);
    $result->bindParam(':password', $hash, PDO::PARAM_STR);
    $result->bindParam(':phone', $phone, PDO::PARAM_STR);
    return $result->execute();
  }

  /**
   * Проверяет авторизирован ли пользователь
   * @return boolean 
   */
  public static function isAuthorized()
  {
    if (isset($_SESSION['user'])) {
      return true;
    }
    return false;
  }

  /**
   * Возвращает ID пользователя из сессии
   * @return mixed: (integer id user / false)
   */
  public static function getId()
  {
    if (isset($_SESSION['user'])) {
			return $_SESSION['user'];
		}
    return false;
  }

  /**
   * Возвращает данные пользователя по ID
   * @return mixed: (array / false)
   */
  public static function getDateUserId($id)
  {
    $db = DB::getConnection();
		
		$sql = 'SELECT * FROM user WHERE id = :id';
		
		$result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();

		return $result->fetch();
  }
	
	/**
	 * Обновляет информацию о пользователе
   * @param string $fio
   * @param string $email
   * @param string $password
   * @param string $phone
   * @return boolean 
	 */
	public static function update($fio, $email, $password, $phone, $id)
	{
		$db = DB::getConnection();

		$sql = 'UPDATE user SET fio = :fio, email = :email, ';
		
		if (!is_null($password)) {
			$sql .= 'password = :password, ';
		}
		
		$sql .= 'phone = :phone WHERE id = :id';

		$result = $db->prepare($sql);
		$result->bindParam(':fio', $fio, PDO::PARAM_STR);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		
		if (!is_null($password)) {
			$hash = password_hash($password, PASSWORD_BCRYPT);
			$result->bindParam(':password', $hash, PDO::PARAM_STR);
		}
		
		$result->bindParam(':phone', $phone, PDO::PARAM_STR);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		
		return $result->execute();
	}
}