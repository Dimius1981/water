<?php
	$TITLE = 'water';

	//путь к папке с log-файлами
	$LOGS_PATH = './logs/';

	//Настройки подключения к ДБ
	$HOST_DB = '127.0.0.1';
	$USER_DB = 'root';
	$PASS_DB = '';
	$NAME_DB = 'water';
	//Время жизни сессии пользователя
	$TIME_LIVE = 2*60;

	//Текущее время
	$CUR_TIME = time();

	//Режим разработчика
	if (isset($_GET['page'])) {$page = $_GET['page'];} else {$page = '';}
	if (($page == 'addrec') ||
	    ($page == 'listrec')) {
	    $NOAUTH = 1;
	} else {
		$NOAUTH = 0; //1 = true, 0 = false
	}
?>