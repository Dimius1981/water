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

	//Доступные функции пользователю
	$func_access_res = access_func_list($user_info['level_id']);
	$func_access_arr = Array();
	while ($row = mysqli_fetch_assoc($func_access_res)) {
		$func_access_arr[$row['func_id']] = $row['state'];
	}

	//print_r($func_access_arr);
	$tpl->assign('func_access', $func_access_arr);










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

		if ($count_data == 0) $count_data = NULL;
		$sensors_vew = array_slice($sensors_arr, $start_data, $count_data);
		$tpl->assign('sensors_list', $sensors_vew);
		if ($f_value == 'json')
			die ( json_encode($sensors_vew) );
		else if ($f_value == '')
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





	//Удаление датчика
	//===================================================
	} elseif ($page == 'delsensor') {
		$log->writeln('Delete sensor:');
		$log->writeln(json_encode($_GET));

		if(isset($_GET['sensor_num'])){
			$del_sensor_num = $_GET['sensor_num'];
		}else{
			$del_sensor_num = 0;
		}

		$data = Array();

		if ($del_sensor_num == 0) {
			$data['error'] = 'Ошибка удаления датчика!';
			$log->writeln('Error: '.$data['error']);
			die ( json_encode($data) );
		}

		$res = del_sensor($del_sensor_num);
		if ($res) {
			$data['result'] = 'OK';
		} else {
			$data['error'] = 'Ошибка удаления датчика!';
		}

		die ( json_encode($data) );






	//Вывод информации о датчике в виде Json
	//===================================================
	} elseif ($page == 'getsensor') {
		$log->writeln('Get sensor info:');
		$log->writeln(json_encode($_GET));

		if(isset($_GET['sensor_num'])){
			$get_sensor_num = $_GET['sensor_num'];
		}else{
			$get_sensor_num = 0;
		}

		$sensor_info_res = get_sensor_by_id($get_sensor_num);
		$sensor_info_arr = mysqli_fetch_assoc($sensor_info_res);

		die ( json_encode($sensor_info_arr) );






	//Обновление информации о датчике Json
	//===================================================
	} elseif ($page == 'updsensor') {
		$log->writeln('Update sensor:');
		$log->writeln(json_encode($_GET));

		if(isset($_GET['set_sensor_number'])){
			$upd_sensor_num = $_GET['set_sensor_number'];
		}else{
			$upd_sensor_num = 0;
		}

		if(isset($_GET['set_sensor_name'])){
			$upd_sensor_name = $_GET['set_sensor_name'];
		}else{
			$upd_sensor_name = '';
		}

		if(isset($_GET['set_sensor_description'])){
			$upd_sensor_description = $_GET['set_sensor_description'];
		}else{
			$upd_sensor_description = '';
		}

		if(isset($_GET['set_sensor_phone'])){
			$upd_sensor_phone = $_GET['set_sensor_phone'];
		}else{
			$upd_sensor_phone = '';
		}

		if(isset($_GET['set_sensor_seth'])){
			$upd_sensor_seth = $_GET['set_sensor_seth'];
		}else{
			$upd_sensor_seth = 0;
		}

		if(isset($_GET['set_sensor_start'])){
			$upd_sensor_start = $_GET['set_sensor_start'];
		}else{
			$upd_sensor_start = '';
		}

		$data = Array();

		$res = upd_sensor($upd_sensor_num, $upd_sensor_name, $upd_sensor_description, $upd_sensor_seth, $upd_sensor_phone, $upd_sensor_start);

		if ($res > 0) {
			$data['result'] = 'OK';
		} else {
			$data['error'] = 'Не удалось сохранить запись в БД!';
			$log->writeln('Error: '.$data['error']);
		}

		die ( json_encode($data) );







	//Обновление таблицы кривой расходов Json
	//===================================================
	} elseif ($page == 'updlevelrashod') {
		$log->writeln('Update table level rashod:');
		$log->writeln(json_encode($_GET));

		$arr_level = $_GET['level_num_row'];
		$arr_rashod = $_GET['rashod_num_row'];
		$sens_id = $_GET['set_sensor_number'];
		//print_r($arr_level);
		//print_r($arr_rashod);

		//echo 'arr_level length = '.count($arr_level).'</br>';
		//echo 'arr_rashod length = '.count($arr_rashod).'</br>';

		$data = Array();

		//Очистим таблицу от старых записей
		$res = del_lvlras($sens_id);
		if (!$res) {
			$data['error'] = 'Не удалось очистить старые записи из БД!';
			$log->writeln('Error: '.$data['error']);
		} else {
			for ($idx = 0; $idx < count($arr_level); $idx++) {

				//Проверим введенные данные, нет ли пустых ячеек
				if ($arr_level[$idx] == '') {
					$arr_level[$idx] = 0;
				}
				if ($arr_rashod[$idx] == '') {
					$arr_rashod[$idx] = 0;
				}

				//Добавим новую запись с расходом и уровнем
				$res = add_lvlras($sens_id, $arr_level[$idx], $arr_rashod[$idx]);
				if (!$res) {
					$data['error'] = 'Не удалось сохранить запись в БД!';
					$log->writeln('Error: '.$data['error']);
					break;
				}
			}
		}

		if ($res > 0) {
			$data['result'] = 'OK';
		} else {
			$log->writeln('Error: '.$data['error']);
		}

		die ( json_encode($data) );





	//Выводит записи из таблицы кривой расходов Json
	//===================================================
	} elseif ($page == 'listlevelrashod') {
		if(isset($_GET['sensor_num'])){
			$sensor_num = $_GET['sensor_num'];
		}else{
			$sensor_num = 0;
		};

		if ($sensor_num > 0) {
			$listlvlras_res = list_lvlras($sensor_num);
			$listlvlras_arr = Array();
			while($row = mysqli_fetch_assoc($listlvlras_res)) {
				$listlvlras_arr[] = $row;
			};
		};

		die ( json_encode($listlvlras_arr) );






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

		//расчет уровня Hw = H - Hsens
		$sensor_info_res = get_sensor_by_id($sens_id);
		$sensor_info_arr = mysqli_fetch_assoc($sensor_info_res);	
		$new_level =  $sensor_info_arr['high'] - $level; 
				
		// 4 точки
		$A1 = 0; // X1
		$A2 = 0; // X2
		$B1 = 0; // Y1
		$B2 = 0; // Y2

		// обращение к таблице расход
		$listlvlras_res = list_lvlras($sens_id);
		$listlvlras_arr = Array();
		while($row = mysqli_fetch_assoc($listlvlras_res)) {
			$listlvlras_arr[] = $row;
			$massivlvl[] = $row['level']; // массив для X
			$massivras[] = $row['rashod']; // массив для Y
		};

		// счетчик для цикла
		$countmassiv = count($massivlvl); 

		//Условие к уравенинию прямой
		if ($new_level >= $massivlvl[0] && $new_level <= end($massivlvl)){
			$j = $new_level;
			for ($i = 0; $i < $countmassiv; $i++) {
				if ($j > $massivlvl[$i]) {
					$A1 = $massivlvl[$i];
					$A2 = $massivlvl[$i+1];
					$B1 = $massivras[$i];
					$B2 = $massivras[$i+1];
					$k = ($B2-$B1)/($A2-$A1);
					$b = $B2 - $k*$A2;
					$rashod = $new_level * $k + $b;
				}else if($j == $massivlvl[$i]){
					$rashod = $massivras[$i];
				};
			};
		}else{
			$rashod = 0;
		};
			
		
		$log -> writeln("Add new rec:");
		$log -> writeln("sens_id = ".$sens_id.", level = ".$level.
			", bat = ".$bat.", reset = ".$reset);
		echo add_record($sens_id, $level, $new_level, $bat, $rashod,  $reset, $lastcode); // $new_level добавить + бд






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

		$list_rec_obj = list_records($sens_id, $start_data, $count_data);
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

		if ($f_value == 'json')
			die ( json_encode($list_rec_arr) );
		else
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
	






	//Вывод строк таблицы с пользователями в HTML формате
	//===================================================
	} elseif ($page == 'users_table') {
		$user_list_res = userlist();
		$user_list_arr = Array();
		while($row = mysqli_fetch_assoc($user_list_res)){
			$user_list_arr[] = $row;
		}

		if ($count_data == 0) $count_data = NULL;
		$user_list_vew = array_slice($user_list_arr, $start_data, $count_data);
		$tpl->assign('userlist_arr', $user_list_vew);
		if ($f_value == 'json')
			die ( json_encode($user_list_vew) );
		else if ($f_value == '')
			$tpl->display('blank.tpl');






	//Удаление пользователя
	//===================================================
	} elseif ($page == 'deleteuser') {
		$log->writeln('Delete user:');
		$log->writeln(json_encode($_GET));

		if(isset($_GET['user_id'])){
			$del_user_id = $_GET['user_id'];
		}else{
			$del_user_id = 0;
		}

		$data = Array();

		if ($del_user_id == 0) {
			$data['error'] = 'Ошибка удаления пользователя!';
			$log->writeln('Error: '.$data['error']);
			die ( json_encode($data) );
		}

		if ($del_user_id == 1) {
			$data['error'] = 'Нельзя удалить администратора!';
			$log->writeln('Error: '.$data['error']);
			die ( json_encode($data) );
		}

		$res = del_user($del_user_id);
		if ($res) {
			$data['result'] = 'OK';
		} else {
			$data['error'] = 'Ошибка удаления пользователя!';
		}

		die ( json_encode($data) );




	//Добавление пользователя
	//===================================================
	} elseif ($page == 'adduser') {
		//Все эти поля должны быть в модальной форме добавления пользователя
		if(isset($_GET['add_user_login'])){
			$add_user_login = $_GET['add_user_login'];
		}else{
			$add_user_login = '';
		}

		if(isset($_GET['add_user_pass'])){
			$add_user_pass = $_GET['add_user_pass'];
		}else{
			$add_user_pass = 0;
		}

		if(isset($_GET['add_user_level_id'])){
			$add_user_level_id = $_GET['add_user_level_id'];
		}else{
			$add_user_level_id = 0; //Пусть будет 0, если не указали level_id
		}

		if(isset($_GET['add_user_email'])){
			$add_user_email = $_GET['add_user_email'];
		}else{
			$add_user_email = '';
		}

		if(isset($_GET['add_user_name'])){
			$add_user_name = $_GET['add_user_name'];
		}else{
			$add_user_name = '';
		}


		$data = Array(); //Объявим массив для вывода результатов

		$res = add_user($add_user_level_id, $add_user_name, $add_user_login, $add_user_pass, $add_user_email);

		//Проверим получилось добавить пользователя
		if ($res) {
			//Если получилось число > 0, то пользователя добавили
			$data['result'] = 'OK';
		} else {
			//Не получилось добавить пользователя
			$data['error'] = 'Не удалось добавить пользователя в БД!';
			$log->writeln('Error: '.$data['error']);
		}

		//Выведем закодированный JSon ответ и завершим скрипт
		die ( json_encode($data) );




	//Вывод информации о пользователе в виде Json
	//===================================================
	} elseif ($page == 'getuser') {
		$log->writeln('Get user info:');
		$log->writeln(json_encode($_GET));

		if(isset($_GET['user_id'])){
			$get_user_id = $_GET['user_id'];
		}else{
			$get_user_id = 0;
		}

		$user_info_res = get_user_by_id($get_user_id);
		$user_info_arr = mysqli_fetch_assoc($user_info_res);

		die ( json_encode($user_info_arr) );






	//Обновление информации о пользователе
	//===================================================
	} elseif ($page == 'upduser') {
		$log->writeln('Update user:');
		$log->writeln(json_encode($_GET));


		if(isset($_GET['edit_user_id'])){
			$edit_user_id = $_GET['edit_user_id'];
		}else{
			$edit_user_id = '';
		}
		if(isset($_GET['edit_user_level_id'])){
			$edit_user_level_id = $_GET['edit_user_level_id'];
		}else{
			$edit_user_level_id = 0; //Пусть будет 0, если не указали level_id
		}
		if(isset($_GET['edit_user_name'])){
			$edit_user_name = $_GET['edit_user_name'];
		}else{
			$edit_user_name = '';
		}
		if(isset($_GET['edit_user_login'])){
			$edit_user_login = $_GET['edit_user_login'];
		}else{
			$edit_user_login = '';
		}
		if(isset($_GET['edit_user_pass'])){
			$edit_user_pass = $_GET['edit_user_pass'];
		}else{
			$edit_user_pass = '';
		}
		if(isset($_GET['edit_user_email'])){
			$edit_user_email = $_GET['edit_user_email'];
		}else{
			$edit_user_email = '';
		}
		if(isset($_GET['edit_user_enabled'])){
			$edit_user_enabled = $_GET['edit_user_enabled'];
		}else{
			$edit_user_enabled = 0;
		}

		if(($edit_user_id == 1) and !$edit_user_enabled) {
			$data['error'] = 'Нельзя заблокировать администратора!';
			$log->writeln('Error: '.$data['error']);
			die ( json_encode($data) );
		}

		if(($edit_user_id == 1) and ($edit_user_level_id !== '1')) {
			$data['error'] = 'Нельзя изменить тип пользователя администратора!';
			$log->writeln('Error: '.$data['error']);
			die ( json_encode($data) );
		}

		$data = Array();
		// Условие если поле пароля пустое 
        if ($_GET['edit_user_pass'] == '') {
        	$res = upd_user_no_pass($edit_user_id, $edit_user_level_id, $edit_user_name, $edit_user_login, $edit_user_email, $edit_user_enabled);
        }else{
        	$res = upd_user($edit_user_id, $edit_user_level_id, $edit_user_name, $edit_user_login, $edit_user_pass, $edit_user_email, $edit_user_enabled);
        }

		// $res = upd_user($edit_user_id, $edit_user_level_id, $edit_user_name, $edit_user_login, $edit_user_pass, $edit_user_email, $edit_user_enabled);

		if ($res > 0) {
			$data['result'] = 'OK';
		} else {
			$data['error'] = 'Не удалось сохранить запись в БД!';
			$log->writeln('Error: '.$data['error']);
		}

		die ( json_encode($data) );



	//Обновление информации о доступности пользователе
	//===================================================
	} elseif ($page == 'upduseren') {
		$log->writeln('Update user enabled:');
		$log->writeln(json_encode($_GET));

		if(isset($_GET['user_id'])){
			$get_user_id = $_GET['user_id'];
		}else{
			$get_user_id = 0;
		}

		if(isset($_GET['user_en'])){
			$get_user_en = $_GET['user_en'];
		}else{
			$get_user_en = '';
		}

		if ($get_user_id == 1) {
			$data['error'] = 'Нельзя заблокировать администратора!';
			$log->writeln('Error: '.$data['error']);
			die ( json_encode($data) );
		}

		$data = Array();
		if (($get_user_id > 0) and (strlen($get_user_en) > 0)) {
			if ($get_user_en == 'true') {
				$user_en = 1;
			} else {
				$user_en = 0;
			}
			$user_en_res = upd_user_enabled($get_user_id, $user_en);
			if ($user_en_res > 0) {
				$data['result'] = 'OK';
			} else {
				$data['error'] = 'Не удалось обновить запись пользователя!';
				$log->writeln('Error: '.$data['error']);
			}
		} else {
			$data['error'] = 'Ошибка в параметрах запроса!';
			$log->writeln('Error: '.$data['error']);
		}

		die ( json_encode($data) );






	//Страница вывода данных датчика
	//===================================================
	} elseif ($page == 'datatable') {
		$tpl->assign('PageTitle', 'Data Table');

		//id - датчика
		if (isset($_GET['sens_id'])) {
			$sens_id = $_GET['sens_id'];
		} else {
			$sens_id = 0;
		}

		//Pagination
		$col_rec_obj = get_count_rec_by_id($sens_id);
		$col_rec = mysqli_fetch_assoc($col_rec_obj);
		$col = $col_rec['count(id)'];
		$page_rec = intdiv($col, $MAX_RECORDS_PAGE);
		$page_half = $col % $MAX_RECORDS_PAGE;
		// echo $col. ' / '. $page_prod. ' / '. $page_half;

		$pagination = Array();
		for ($i = 0; $i < $col; $i = $i + $MAX_RECORDS_PAGE) {
			$pagination[] = $i;
		}

		// print_r($pagination);

		$prev_page = $start_data - $MAX_RECORDS_PAGE;
		if ($prev_page < 0)
			$prev_page = -1;

		$next_page = $start_data + $MAX_RECORDS_PAGE;
		if ($next_page > $col)
			$next_page = -1;

		$tpl->assign('pagination', $pagination);
		$tpl->assign('start', $start_data);
		$tpl->assign('prev_page', $prev_page);
		$tpl->assign('next_page', $next_page);

		$sensor_info_res = get_sensor_by_id($sens_id);
		$sensor_info_arr = mysqli_fetch_assoc($sensor_info_res);
		
		$list_rec_obj = list_records($sens_id, $start_data, $count_data);
		$list_rec_arr = Array();
		
		while ($row = mysqli_fetch_assoc($list_rec_obj)) {	
			$list_rec_arr[] = $row;
		};

		$tpl->assign('listrec', $list_rec_arr);
		$tpl->assign('sensor_info', $sensor_info_arr);
		$tpl->assign('list_rashod', $listlvlras_arr);

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