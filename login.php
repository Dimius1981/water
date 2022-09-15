<?php
	@session_start();

	include('./configs/config.php');
	include('./core/libs/Smarty.class.php'); //Шаблонизатор
	include('./core/database.php');

	$tpl = new Smarty; //Создание объекта Smarty

	if (!empty($_POST['login']) && !empty($_POST['password'])) {
		authorization($_POST['login'], $_POST['password']);
		header('Location: ./', true, 301);
	}
	if (isset($_GET['logout'])) {
		userlogout($_SESSION['id']);
		@session_destroy();
		header('Location: ./login.php', true, 301);
	}

	$tpl->display('autho.tpl');
?>