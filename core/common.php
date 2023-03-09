<?php
//Класс log-файла
class logFile {
	var $file = "";

	function init() {
	global $LOGS_PATH;
		$this->file = $LOGS_PATH.@date("Ymd", time()+$LOCAL_TIME).".log";
		//echo $this->file;
	}

	function write($str, $f_time = TRUE) {
		$fp = fopen($this->file, 'a');
		if ($fp) {
            if ($f_time) {
            	fwrite($fp, @date("H:i:s", time()+$LOCAL_TIME)." | ".$str);
            } else {
            	fwrite($fp, $str);
            }

			fclose($fp);
		}
	}

	function writeln($str, $f_time = TRUE) {
		$fp = fopen($this->file, 'a');
		if ($fp) {
            if ($f_time) {
				fwrite($fp, @date("H:i:s", time()+$LOCAL_TIME)." | ".$str."\r\n");
			} else {
				fwrite($fp, $str."\r\n");
			}

			fclose($fp);
		}
	}

} // logFile

//Создадим и инициируем объект log-файла
$log = new logFile;
$log->init();

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

if ($user_info['id'] > 0) {
	$login_time_unix = strtotime($user_info['date_login']);

	$user_time = $CUR_TIME - $login_time_unix;


	//Проверка на выход пользователя
	if ((isset($_GET['logout'])) || ($user_time > $TIME_LIVE)) {
		userlogout($_SESSION['id']);
		session_destroy();
		header('Location: ./login.php', true, 301); //После выхода перенаправляемся на главную страницу
	} else {
		usertimeupdate($session_id);
	}
}

$scripts = '';

	//Главная страница (Таблица датчиков)
	//===================================================
	if ($page == '') {
		$content = "{include file='tablemain.tpl'}";
		$scripts = '<script src="templates/js/sensors.js"></script>';



	//Вывод строк таблицы с датчиками в HTML формате
	//===================================================
	} elseif ($page == 'sensors_table') {
		$content = "{include file='sensors_table.tpl'}";



	//Добавление нового датчика Json
	//===================================================
	} elseif ($page == 'addsensor') {
		$content = 'Add sensor page';



	//Удаление датчика
	//===================================================
	} elseif ($page == 'delsensor') {
		$content = 'Delete sensor page';




	//Вывод информации о датчике в виде Json
	//===================================================
	} elseif ($page == 'getsensor') {
		$content = 'Get sensor page';



	//Обновление информации о датчике Json
	//===================================================
	} elseif ($page == 'updsensor') {
		$content = 'Update sensor page';






		



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
		$scripts = '<script src="templates/js/users.js"></script>';



	//Вывод строк таблицы с пользователями в HTML формате
	//===================================================
	} elseif ($page == 'users_table') {
		$content = "{include file='users_table.tpl'}";



	//Удаление пользователя
	//===================================================
	} elseif ($page == 'deleteuser') {
		$content = "Delete User";



	//Добавление пользователя
	//===================================================
	} elseif ($page == 'adduser') {
		$content = "Add User";



	//Вывод информации о пользователе в виде Json
	//===================================================
	} elseif ($page == 'getuser') {
		$content = "Get user page";



	//Обновление информации о пользователе
	//===================================================
	} elseif ($page == 'upduser') {
		$content = "Update user page";



	//Обновление информации о доступности пользователе
	//===================================================
	} elseif ($page == 'upduseren') {
		$content = "Update user enable page";



















	//Страница вывода данных датчика
	//===================================================
	} elseif ($page == 'datatable') {
		$content = "{include file='datatable.tpl'}";
		//$scripts = '<script src="templates/js/users.js"></script>'

















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

