<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
        <link rel="shortcut icon" href="/template/images/ico/favicon.ico">
        <title>Интернет-магазин OZMARKET</title>
        <meta name="description" content="OZMARKET">
        <meta name="keywords" content="OZMARKET">

        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="/template/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link href="/template/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <!--  Scripts-->
      <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    </head>
    <body>
		<nav class="light-blue lighten-1" role="navigation">
			<div class="nav-wrapper container"><a id="logo-container" href="/" class="brand-logo">OZMARKET</a>
				<ul class="right hide-on-med-and-down">
					<?php if (AccountModel::isAuthorized()): ?>
						<li><a href="/account/" title="Личный кабинет"><i class="material-icons">account_circle</i></a></a></li>
						<li><a href="/logout/" title="Выйти"><i class="material-icons">open_in_new</i></a></a></li>
					<?php else: ?>
						<li><a href="/login/" title="Войти"><i class="material-icons">input</i></a></li>
					<?php endif; ?>
				</ul>

				<ul id="nav-mobile" class="side-nav">
					<?php if (AccountModel::isAuthorized()): ?>
						<li><a href="/account/">Личный кабинет</a></li>
						<li><a href="#">Выйти</a></li>
					<?php else: ?>
						<li><a href="/login/">Войти</a></li>
						<li><a href="/register/">Регистрация</a></li>
					<?php endif; ?>
				</ul>
				<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
			</div>
		</nav>
		<div class="container">