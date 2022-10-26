<?php
	$tpl = new Smarty; //Создание объекта Smarty

	//$tpl->caching = true; //Включаем кэширование
	//$tpl->cache_lifetime = 120;

	// http://myshop/?page=about
	$tpl->assign('user_info', $user_info);
	$tpl->assign('cur_time', @date('Y.d.m H:i:s', $CUR_TIME));
		
		

	// Главная страница
	//===================================================
	if ($page == '') {
		$tpl->assign('PageTitle', 'Main page');
		$tpl->assign('Content', $content);

		$log -> writeln("Main page");

		//функция для выделении таблиц
		//зеленый цвет - датчик регулярно выходит на связь; желтый цвет - датчик не выходит на связь уже 3 раза; красный цвет - датчик не выходит на связь более 3 раз
		//$res = ...
        //<? while ($row = mysql_fetch_array($res)) {
		//if($row['status']==1){$bg='.table-success';{}
		//ifelse{$bg='.table-warning';}{}
		//else{$bg='.table-danger';}{}}
		//} 
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

		$log -> writeln("Add new rec:");
		$log -> writeln("sens_id = ".$sens_id.", level = ".$level.
			", bat = ".$bat.", reset = ".$reset);
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

		$log -> writeln("listrec page for sensor_id: ".$sens_id);

		$tpl->assign('PageTitle', 'Данные датчика '.$sens_id);
		$tpl->assign('Content', $content);

		$list_rec_obj = list_records($sens_id);
		$list_rec_arr = Array();
		while ($row = mysqli_fetch_assoc($list_rec_obj)) {
			$list_rec_arr[] = $row;
		}
		$tpl->assign('listrec', $list_rec_arr);

		$last_rec = mysqli_fetch_assoc(last_record($sens_id));

		$sensor_info = mysqli_fetch_assoc(get_sensor_by_id($sens_id));

		$last_date = date_create($last_rec['date_insert']);
		$start_date = date_create($sensor_info['start_work']);
		$sensor_date_live = date_diff($last_date, $start_date);

		//print_r($sensor_info);

		//echo "start_work = ".$sensor_info['start_work']."</br>";
		//echo "last_date = ".$last_rec['date_insert'];

		$tpl->assign('sensor_date_live', $sensor_date_live->format("%d д. %H:%i:%s"));

		$tpl->display('empty.tpl');






	//Страница 404
	//===================================================
	} else {
		$tpl->assign('PageTitle', '404');
		$tpl->assign('Content', $content);

		$log -> writeln("Error 404. Page \"".$page."\" not found!");
		
		$tpl->display('main.tpl');

	}


?>