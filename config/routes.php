<?php

return array(
	// Контакты
	'order/getContact/([0-9]+)' => 'order/getContact/$1',
	'order/getContactSell/([0-9]+)' => 'order/getContactSell/$1',
	// Купить товаров
	'order/addAjax/([0-9]+)' => 'order/addAjax/$1',
	// Категория товаров
	'product/([0-9]+)' => 'product/index/$1', 
	'category/([0-9]+)/order-([A-Za-z]+)/page-([0-9]+)' => 'category/index/$1/$2/$3', 
	'category/([0-9]+)/order-([A-Za-z_]+)' => 'category/index/$1/$2', 
	'category/([0-9]+)/page-([0-9]+)' => 'category/index/$1/last/$2', 
	'category/([0-9]+)' => 'category/index/$1',
	// Товары в кабинете пользователя
	'account/product/sell' => 'accountProduct/sell',
	'account/product/create' => 'accountProduct/create',
	'account/product/update/([0-9]+)' => 'accountProduct/update/$1',
	'account/product/delete/([0-9]+)' => 'accountProduct/delete/$1',
	'account/product' => 'accountProduct/index',
	// Пользователь
	'account/edit' => 'account/edit',
	'account' => 'account/index',
	'login' => 'account/login',
	'register' => 'account/register',
	'logout' => 'account/logout',
	// Главная страница
	'index.php' => 'home/index',
	'' => 'home/index',
);