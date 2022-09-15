<?php
session_start();

include('./configs/config.php'); //Настрйоки сайта

if ($NOAUTH == 1 || $_SESSION['id'] >= 1) {
	include('./core/libs/Smarty.class.php'); //Шаблонизатор
	include('./core/database.php'); // Работа с базами данных
	include('./core/common.php'); // Общие запросы
	include('./core/common_tpl.php'); //Управление шаблоном
} else {
	session_destroy();
	header( 'Location: ./login.php', true, 301 );
}

?>