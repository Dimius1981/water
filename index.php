<?php
session_start();

include('./configs/config.php'); //Настрйоки сайта

$data = Array();
if(isset($_GET['f'])){$f_value = $_GET['f'];}else{$f_value = '';}

if ($NOAUTH == 1 || $_SESSION['id'] >= 1) {
	include('./core/libs/Smarty.class.php'); //Шаблонизатор
	include('./core/database.php'); // Работа с базами данных
	include('./core/common.php'); // Общие запросы
	include('./core/common_tpl.php'); //Управление шаблоном
} else {
	if ($f_value == 'json') {
		$data['error'] = 'Autorization Error';
		die ( json_encode($data) );
	} else if ($f_value == '') {
		header( 'Location: ./login.php', true, 301 );
	}
	session_destroy();
}

?>