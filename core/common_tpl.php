<?php
	$tpl = new Smarty; //Создание объекта Smarty

	//$tpl->caching = true; //Включаем кэширование
	//$tpl->cache_lifetime = 120;

	// http://myshop/?page=about
	$tpl->assign('user_info', $user_info);
		
		

	// Главная страница
	//===================================================
	if ($page == '') {
		$tpl->assign('PageTitle', 'Main page');
		$tpl->assign('Content', $content);

		$tpl->display('main.tpl');




	//Страница добавления новой записи
	//===================================================
	} elseif ($page == 'addrec') {
		//Получаем данные и записываем их в базу данных
		//id - датчика
		if (isset($_GET['sens_id'])) {
			$sens_id = $_GET['sens_id'];
		} else {
			$sens_id = 0;
		}

		//Измеренный уровень
		if (isset($_GET['level'])) {
			$level = $_GET['level'];
		} else {
			$level = 0;
		}

		//Уровень заряда батареи
		if (isset($_GET['bat'])) {
			$bat = $_GET['bat'];
		} else {
			$bat = 0;
		}

		//Статус сброса датчика
		if (isset($_GET['reset'])) {
			$reset = $_GET['reset'];
		} else {
			$reset = '';
		}

		//Код последнего HTTP запроса
		if (isset($_GET['lastcode'])) {
			$lastcode = $_GET['lastcode'];
		} else {
			$lastcode = '';
		}

		echo add_record($sens_id, $level, $bat, 0, $reset, $lastcode);






	//Страница отображает последние 30 записей в порядке убывания
	//===================================================
	} elseif ($page == 'listrec') {
		//id - датчика
		if (isset($_GET['sens_id'])) {
			$sens_id = $_GET['sens_id'];
		} else {
			$sens_id = 0;
		}

		$list_rec_obj = list_records($sens_id);
		$list_rec_arr = Array();
		while ($row = mysqli_fetch_assoc($list_rec_obj)) {
			$list_rec_arr[] = $row;
		}
		$tpl->assign('listrec', $list_rec_arr);

		$tpl->display('listrec.tpl');






	//Страница 404
	//===================================================
	} else {
		$tpl->assign('PageTitle', '404');
		$tpl->assign('Content', $content);
		
		$tpl->display('main.tpl');

	}


?>