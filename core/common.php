<?php
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page ='';
	}

	if (!isset($_SESSION['id'])) {
		$session_id = -1;
	} else {
		$session_id = $_SESSION['id'];
	}

	$user_info = userinfo($session_id);
	//print_r($user_info);

if ($user_info) {
	$login_time_unix = strtotime($user_info['date_login']);

	$user_time = $cur_time_unix - $login_time_unix;


	//Проверка на выход пользователя
	if ((isset($_GET['logout'])) || ($user_time > $TIME_LIVE)) {
		userlogout($_SESSION['id']);
		session_destroy();
		header('Location: ./login.php', true, 301); //После выхода перенаправляемся на главную страницу
	} else {
		usertimeupdate($session_id);
	}
}


	//Главная страница
	//===================================================
	if ($page == '') {
		$content = "{include file='tablemain.tpl'}";
		
		



	//Страница добавления новой записи
	//===================================================
	} elseif ($page == 'addrec') {
		$content = 'Add record page';





	//Страница отображает последние 30 записей в порядке убывания
	//===================================================
	} elseif ($page == 'listrec') {
		$content = "{include file='listrec.tpl'}";





	//Страница отображает загруженные файлы
	//===================================================
	} elseif ($page == 'downloads') {
		$content = "{include file='downloads.tpl'}";





	//Страница редактирования пользователей(админ)
	//===================================================
	} elseif ($page == 'users') {
		$content = "{include file='users.tpl'}";







	//Страница Журнал
	//===================================================
	} elseif ($page == 'logs') {
		// $content = "{include file='logs.tpl'}";









	//Страница 404
	//===================================================
	} else {
		$content = '<h3> 404 page</h3>';
	
	}
?>

