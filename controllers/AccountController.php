<?php
/**
 * AccountController
 */
 
class AccountController
{
	// Action для главной страницы аккаунта
	public function actionIndex()
	{
		if(!AccountModel::isAuthorized()) header("Location: /login/");
    
		$arOrders = OrderModel::getOrdersById(AccountModel::getId());
		
		// Подключение вида
    require_once(ROOT . '/views/account/index.php');
    return true;
	}
	
	// Action для страницы входа
	public function actionLogin()
	{
		if(AccountModel::isAuthorized()) header("Location: /account/");
	
		if (isset($_POST['submit'])) {
			$email = $_POST['email'];
			$password = $_POST['password'];
			$errors = array();

			if (!AccountModel::checkEmail($email)) {
				$errors[] = 'Неправильный email.';
			}
			if (!AccountModel::checkPassword($password)) {
				$errors[] = 'Пароль не должен быть короче 6-ти символов.';
			}
		
			if (empty($errors)) {
				$userId = AccountModel::checkUserData($email, $password);

				if ($userId === false) {
					$errors[] = 'Неверные данные для авторизации.';
				} else {
					AccountModel::auth($userId);
				
					header("Location: /account/");
				}
			}
		}

		// Подключение вида
		require_once(ROOT . '/views/account/login.php');
		return true;
	}


	// Action для страницы регистрации
	public function actionRegister()
	{
		if(AccountModel::isAuthorized()) header("Location: /account/");
		
		$res = false;
	
		if (isset($_POST['submit'])) {
			$fio = $_POST['fio'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$confirmPassword = $_POST['confirm_password'];
			$phone = $_POST['phone'];
			$errors = array();

			if (!AccountModel::checkFio($fio)) {
				$errors[] = 'Некорректно введены ФИО.';
			}
			if (!AccountModel::checkEmail($email)) {
				$errors[] = 'Неверный email.';
			}
			if (!AccountModel::checkPassword($password)) {
				$errors[] = 'Пароль не должен быть короче 6-ти символов.';
			}
			if (empty($errors) && !AccountModel::comparePassword($password, $confirmPassword)) {
				$errors[] = 'Пароли не совпадают.';
			}
			if (!empty($phone) && !AccountModel::checkPhone($phone)) {
				$errors[] = 'Введен не корректный телефон. Пример: +375(29)123-45-67';
			}
			if (empty($errors) && AccountModel::checkEmailExists($email)) {
				$errors[] = 'Такой email уже зарегистрирован.';
			}
			
			if (empty($errors)) {
				$res = AccountModel::register($fio, $email, $password, $phone);
			}
		}

		// Подключаем вид
		require_once(ROOT . '/views/account/register.php');
		return true;
	}

	/**
	 * Разлогинивание
	 */
	public static function actionLogout()
	{
		unset($_SESSION["user"]);
		
		header("Location: /");
	}

	/**
	 * Action для страницы изменения профиля
	 */
	public static function actionEdit()
	{
		if(!AccountModel::isAuthorized()) header("Location: /login/");
		
		if (isset($_POST['submit'])) {
			$fio = $_POST['fio'];
			$email = $_POST['email'];
			$old_password = $_POST['old_password'];
			$password = $_POST['password'];
			$confirmPassword = $_POST['confirm_password'];
			$phone = $_POST['phone'];
			$errors = array();

			if (!AccountModel::checkFio($fio)) {
				$errors[] = 'Некорректно введены ФИО.';
			}
			if (!AccountModel::checkEmail($email)) {
				$errors[] = 'Неверный email.';
			}
			if (!empty($phone) && !AccountModel::checkPhone($phone)) {
				$errors[] = 'Введен не корректный телефон. Пример: +375(29)123-45-67';
			}
			if (empty($old_password)) {
				$password = null;
			} else {
				if (!AccountModel::checkOldPassword($old_password, AccountModel::getId())) {
					$errors[] = 'Неверный старый пароль.';
				}
				if (!AccountModel::checkPassword($password)) {
					$errors[] = 'Пароль не должен быть короче 6-ти символов.';
				}
				if (empty($errors) && !AccountModel::comparePassword($password, $confirmPassword)) {
					$errors[] = 'Пароли не совпадают.';
				}
			}
			
			if (empty($errors)) {
				$res = AccountModel::update($fio, $email, $password, $phone, AccountModel::getId());
			}
		}
    
		$arDateUser = AccountModel::getDateUserId(AccountModel::getId());
		
		// Подключение вида
    require_once(ROOT . '/views/account/edit.php');
    return true;
	}
}