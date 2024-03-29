<?php
// Подключение к базе данных
$connect = @mysqli_connect($HOST_DB, $USER_DB, $PASS_DB, $NAME_DB);


if (mysqli_connect_errno()){
	$log -> writeln('ERROR: '.mysqli_connect_errno());
	exit();
}

//Функция для входа 
function authorization($login, $password){
	global $connect;
	global $log;

	$new_pass = MD5($password);
	//echo $new_pass;
	$sql = "SELECT * FROM users WHERE login = '$login' AND pass = '$new_pass' AND enabled = 1";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
	} else {
		$res_arr = mysqli_fetch_assoc($result);
		if ($res_arr) {
			$_SESSION['id'] = $res_arr['id'];
			usertimeupdate($res_arr['id']);
		}
	}

}

function userinfo($session_id){
	global $connect;
	global $log;

	$sql = "SELECT * FROM users WHERE id = $session_id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
	} else {
		$assoc_res = mysqli_fetch_assoc($result);
		if (!$assoc_res) {
			$assoc_res['id'] = '-1';
			$assoc_res['level_id'] = '-1';
			$assoc_res['name'] = '';
			$assoc_res['login'] = '';
			$assoc_res['pass'] = '';
		}
		return $assoc_res;
	}
}

function usertimeupdate($user_id){
	global $connect;
	global $log;

	$sql = "UPDATE users SET date_login = NOW() WHERE id = ".$user_id;
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
	}
}


// Выход из системы
function userlogout($userid) {
	global $connect;

	$sql = "UPDATE user SET date_logout = NOW() WHERE id = ".$userid;
	@mysqli_query($connect, $sql);
}














// Добавляет новую запись в таблицу records
function add_record($sensor_id, $level, $new_level, $bat, $rashod, $reset, $lastcode) {
	global $connect;
	global $log;

	$sql = "INSERT INTO records(id, sensor_id, level, new_level, bat, rashod, date_insert, reset, lastcode) VALUES (NULL, $sensor_id, $level, $new_level, $bat, $rashod, NOW(), '$reset', $lastcode);";

	@mysqli_query($connect, $sql);
	if (mysqli_error($connect)) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
		return 0;
	} else {
		return mysqli_insert_id($connect);
	}
}



//Функция выводит последние count записей датчика sensor_id
//наиная с start
function list_records($sensor_id, $start = 0, $count = 0){
	global $connect;
	global $log;

	if (($start >= 0) && ($count > 0))
		$sql = "SELECT * FROM records WHERE sensor_id = $sensor_id ORDER BY date_insert DESC LIMIT $start, $count;";
	else
		$sql = "SELECT * FROM records WHERE sensor_id = $sensor_id ORDER BY date_insert DESC;";

	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
	} else {
		return $result;
	}
}






//Функция выводит последнюю запись датчика sensor_id
function last_record($sensor_id){
	global $connect;
	global $log;

	$sql = "SELECT * FROM records WHERE date_insert = (SELECT MAX(date_insert) FROM records WHERE sensor_id = $sensor_id) AND sensor_id = $sensor_id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
	} else {
		return $result;
	}
}







//Функция выводит запись о датчике $sensor_id
function get_sensor_by_id($sensor_id){
	global $connect;
	global $log;

	$sql = "SELECT * FROM sensors WHERE factorynumber = $sensor_id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
	} else {
		return $result;
	}
}




//Функция выводит список датчиков
function list_sensors(){
	global $connect;
	global $log;

	$sql = "SELECT * FROM sensors ORDER BY factorynumber;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
	} else {
		return $result;
	}
}




// Добавляет новую запись в таблицу sensors
function add_sensor($factorynumber, $name, $description, $high, $gsmnum) {
	global $connect;
	global $log;

	$sql = "INSERT INTO sensors(id, factorynumber, name, lastindication, date, sum, description, model, high, gsmnum, start_work) VALUES (NULL, $factorynumber, '$name', 0, NOW(), 0, '$description', 'МСД-1', $high, '$gsmnum', NOW());";

	@mysqli_query($connect, $sql);
	if (mysqli_error($connect)) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
		return 0;
	} else {
		return mysqli_insert_id($connect);
	}
}




//Удаляет датчик из таблицы sensors
function del_sensor($sensor_id) {
	global $connect;
	global $log;

	$sql = "DELETE FROM sensors WHERE factorynumber = $sensor_id";
	@mysqli_query($connect, $sql);
	if (mysqli_error($connect)) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
		return 0;
	} else {
		return 1;
	}
}




//Обновление записи датчика по заводскому номеру
function upd_sensor($sensor_id, $name, $description, $high, $gsmnum, $start_work) {
	global $connect;
	global $log;

	$sql = "UPDATE sensors SET name = '$name', description = '$description', high = $high, gsmnum = '$gsmnum', start_work = '$start_work' WHERE factorynumber = $sensor_id";
	@mysqli_query($connect, $sql);
	if (mysqli_error($connect)) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
		return 0;
	} else {
		return 1;
	}

}




//=====================Пользователи=========================

// Вывод пользователей
function userlist() {
	global $connect;
	global $log;

	$sql = "SELECT * FROM users";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
		return 0;
	} else {
		return $result;
	}
}

//Функция выводит запись о пользователе $user_id
function get_user_by_id($user_id){
	global $connect;
	global $log;

	$sql = "SELECT * FROM users WHERE id = $user_id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
	} else {
		return $result;
	}
}


// Добавляет новую запись в таблицу пользователи
// здесь забыл добавить $name - у пользователя же имя есть)
function add_user($level_id, $name, $login, $pass, $email) {
	global $connect;
	global $log;

	$str_pass = MD5($pass);
	// printf($str_pass);

	//Здесь перечисляются поля в том порядке в котором они в базе записаны
	$sql = "INSERT INTO users (id, level_id, name, login, pass, date_login, email, enabled) VALUES (NULL, $level_id, '$name', '$login', '$str_pass', NOW(), '$email', 1);";

	@mysqli_query($connect, $sql);
	if (mysqli_error($connect)) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
		return 0;
	} else {
		return mysqli_insert_id($connect);
	}
}



//Удаление пользователя
function del_user($id) {
	global $connect;
	global $log;

	$sql = "DELETE FROM users WHERE id = $id";
	@mysqli_query($connect, $sql);
	if (mysqli_error($connect)) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
		return 0;
	} else {
		return 1;
	}
}




//Обновление записи пользователя
function upd_user($id,$level_id, $name, $login, $pass, $email,$enabled) {
	global $connect;
	global $log;

	$str_pass = MD5($pass);

	$sql = "UPDATE users SET level_id = $level_id, name = '$name', login = '$login', pass = '$str_pass', email = '$email', enabled = $enabled WHERE id = $id";
	@mysqli_query($connect, $sql);
	if (mysqli_error($connect)) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
		return 0;
	} else {
		return 1;
	}

}

//Обновление записи пользователя без пароля
function upd_user_no_pass($id,$level_id, $name, $login, $email,$enabled) {
	global $connect;
	global $log;

	$sql = "UPDATE users SET level_id = $level_id, name = '$name', login = '$login',  email = '$email', enabled = $enabled WHERE id = $id";
	@mysqli_query($connect, $sql);
	if (mysqli_error($connect)) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
		return 0;
	} else {
		return 1;
	}

}





//Обновление записи пользователя
function upd_user_enabled($id, $enabled) {
	global $connect;
	global $log;

	$sql = "UPDATE users SET enabled = $enabled WHERE id = $id";
	@mysqli_query($connect, $sql);
	if (mysqli_error($connect)) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
		return 0;
	} else {
		return 1;
	}

}














//Доступные функции пользователя
function access_func_list($level_id) {
	global $connect;
	global $log;

	$sql = "SELECT * FROM access_users WHERE level_id = $level_id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
		return 0;
	} else {
		return $result;
	}
}







//Функция возвращает количество записей у датчика с sens_id
function get_count_rec_by_id($sens_id) {
	global $connect;
	global $log;

	$sql = "SELECT count(id) FROM records WHERE sensor_id = $sens_id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
		return 0;
	} else {
		return $result;
	}
}






















// Добавляет новую запись в таблицу level_rashod
function add_lvlras($sensor_id, $level, $rashod) {
	global $connect;
	global $log;

	$sql = "INSERT INTO level_rashod(id, sensor_id, level, rashod) VALUES (NULL, $sensor_id, $level, $rashod);";

	@mysqli_query($connect, $sql);
	if (mysqli_error($connect)) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
		return 0;
	} else {
		return mysqli_insert_id($connect);
	}
}





//Удаляет записи из таблицы level_rashod
function del_lvlras($sensor_id) {
	global $connect;
	global $log;

	$sql = "DELETE FROM level_rashod WHERE sensor_id = $sensor_id";
	@mysqli_query($connect, $sql);
	if (mysqli_error($connect)) {
		$log -> writeln("MySQL Error: ".mysqli_error($connect)."\r\n");
		$log -> writeln("SQL = \"". $sql . "\"");
		return 0;
	} else {
		return 1;
	}
}





// Вывод записи для датчика sensor_id из таблицы level_rashod
function list_lvlras($sensor_id) {
	global $connect;
	global $log;

	$sql = "SELECT * FROM level_rashod WHERE sensor_id = $sensor_id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
		return 0;
	} else {
		return $result;
	}
}

?>