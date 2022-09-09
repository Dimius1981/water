<?php
session_start();

	include('./configs/config.php'); //Настрйоки сайта
	include('./core/libs/Smarty.class.php'); //Шаблонизатор
	include('./core/database.php'); // Работа с базами данных
	include('./core/common.php'); // Общие запросы
	include('./core/common_tpl.php'); //Управление шаблоном
?>