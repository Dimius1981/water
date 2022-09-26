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

		echo add_record($sens_id, $level, $bat, 0);






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