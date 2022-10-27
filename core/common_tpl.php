<?php
	$tpl = new Smarty; //Создание объекта Smarty

	//$tpl->caching = true; //Включаем кэширование
	//$tpl->cache_lifetime = 120;

	// http://myshop/?page=about
	$tpl->assign('user_info', $user_info);
	$tpl->assign('cur_time', @date('Y.d.m H:i:s', $CUR_TIME));
	$tpl->assign('page', $page);
	$tpl->assign('Content', $content);
	$tpl->assign('scripts', $scripts);
		

	//Главная страница (Таблица датчиков)
	//===================================================
	if ($page == '') {
		$tpl->assign('PageTitle', 'Main page');
		$log -> writeln("Main page");
		$tpl->display('main.tpl');






	//Вывод строк таблицы с датчиками в HTML формате
	//===================================================
	} elseif ($page == 'sensors_table') {
		//функция для выделении таблиц
		//зеленый цвет - датчик регулярно выходит на связь; желтый цвет - датчик не выходит на связь уже 3 раза; красный цвет - датчик не выходит на связь более 3 раз
		//$res = ...
        //<? while ($row = mysql_fetch_array($res)) {
		//if($row['status']==1){$bg='.table-success';{}
		//ifelse{$bg='.table-warning';}{}
		//else{$bg='.table-danger';}{}}
		//}

		$sensors_res = list_sensors();
		$sensors_arr = Array();
		while($row = mysqli_fetch_assoc($sensors_res)) {
			//Запросим последнюю запись сделанную датчиком
			$last_record_res = last_record($row['id']);
			$last_record = mysqli_fetch_assoc($last_record_res);
			if (mysqli_num_rows($last_record_res) == 0) {
				$row['last_level'] = 0;
				$row['last_rashod'] = 0;
				$row['last_bat'] = 0;
				$row['last_date'] = 0;

				$last_date = date_create($row['start_work']);
				$start_date = date_create($row['start_work']);
			} else {
				$row['last_level'] = $last_record['level'];
				$row['last_rashod'] = $last_record['rashod'];
				$row['last_bat'] = $last_record['bat'];
				$row['last_date'] = $last_record['date_insert'];

				$last_date = date_create($last_record['date_insert']);
				$start_date = date_create($row['start_work']);
			}
			$sensor_date_live = date_diff($last_date, $start_date);
			$row['sensor_date_live'] = $sensor_date_live->format("%d д. %H:%i:%s");

			$row['row_style'] = "table-primary";
			$sensors_arr[] = $row;
		}

		$tpl->assign('sensors_list', $sensors_arr);
		$tpl->display('blank.tpl');




	//Добавление нового датчика Json
	//===================================================
	} elseif ($page == 'addsensor') {
		$log->writeln('Add new sensor:');
		$log->writeln(json_encode($_GET));

		if(isset($_GET['add_sensor_name'])){
			$add_sensor_name = $_GET['add_sensor_name'];
		}else{
			$add_sensor_name = '';
		}

		if(isset($_GET['add_sensor_number'])){
			$add_sensor_number = $_GET['add_sensor_number'];
		}else{
			$add_sensor_number = 0;
		}

		if(isset($_GET['add_sensor_description'])){
			$add_sensor_description = $_GET['add_sensor_description'];
		}else{
			$add_sensor_description = '';
		}

		if(isset($_GET['add_sensor_phone'])){
			$add_sensor_phone = $_GET['add_sensor_phone'];
		}else{
			$add_sensor_phone = '';
		}

		if(isset($_GET['add_sensor_seth'])){
			$add_sensor_seth = $_GET['add_sensor_seth'];
		}else{
			$add_sensor_seth = 0;
		}

		$data = Array();

		if ($add_sensor_name == '') {
			$data['error'] = 'Имя не должно быть пустым!';
			$log->writeln('Error: '.$data['error']);
			die ( json_encode($data) );
		}

		if ($add_sensor_number == 0) {
			$data['error'] = 'Заводской номер датчика не должен быть равен 0!';
			$log->writeln('Error: '.$data['error']);
			die ( json_encode($data) );
		}

		//Проверим наличие датчика с введенным заводским номером в базе
		$get_sensor_res = get_sensor_by_id($add_sensor_number);
		$log->writeln('mysqli_num_rows = '.mysqli_num_rows($get_sensor_res));
		if (mysqli_num_rows($get_sensor_res) > 0) {
			$data['error'] = 'Датчик с номером \''.$add_sensor_number.'\' уже существует!';
			$log->writeln('Error: '.$data['error']);
			die ( json_encode($data) );
		}

		$res = add_sensor($add_sensor_number, $add_sensor_name, $add_sensor_description, $add_sensor_seth, $add_sensor_phone);

		if ($res > 0) {
			$data['result'] = 'OK';
		} else {
			$data['error'] = 'Не удалось сохранить запись в БД!';
			$log->writeln('Error: '.$data['error']);
		}

		die ( json_encode($data) );










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


	//Страница отображает загруженные файлы
	//===================================================
	} elseif ($page == 'downloads') {
		$tpl->assign('PageTitle', 'Downloads');
		$tpl->display('main.tpl');





	//Страница редактирования пользователей(админ)
	//===================================================
	} elseif ($page == 'users') {
		$tpl->assign('PageTitle', 'Users');
		$tpl->display('main.tpl');







	//Страница Журнал
	//===================================================
	} elseif ($page == 'logs') {
		$tpl->assign('PageTitle', 'Logs');
		$tpl->display('main.tpl');






	//Страница 404
	//===================================================
	} else {
		$tpl->assign('PageTitle', '404');
		$log->writeln("Error 404. Page \"".$page."\" not found!");
		$tpl->display('main.tpl');

	}


?>