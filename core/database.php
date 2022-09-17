<?php
// Подключение к базе данных
$connect = @mysqli_connect($HOST_DB, $USER_DB, $PASS_DB, $NAME_DB);


if (mysqli_connect_errno()){
	echo 'ERROR: '.mysqli_connect_errno();
	exit();
}

//Функция для входа 
function authorization($login, $password){
	global $connect;

	$new_pass = MD5($password);
	//echo $new_pass;
	$sql = "SELECT * FROM users WHERE login = '$login' AND pass = '$new_pass'";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
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

	$sql = "SELECT * FROM users WHERE id = $session_id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	} else {
	return mysqli_fetch_assoc($result);
	}
}

function usertimeupdate($user_id){
	global $connect;

	$sql = "UPDATE users SET date_login = NOW() WHERE id = ".$user_id;
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}
}


// Выход из системы
function userlogout($userid) {
	global $connect;

	$sql = "UPDATE user SET date_logout = NOW() WHERE id = ".$userid;
	@mysqli_query($connect, $sql);
}














// Добавляет новую запись в таблицу records
function add_record($sensor_id, $level, $bat, $rashod, $reset, $lastcode) {
	global $connect;

	$sql = "INSERT INTO records(id, sensor_id, level, bat, rashod, date_insert, reset, lastcode) VALUES (NULL, $sensor_id, $level, $bat, $rashod, NOW(), '$reset', $lastcode);";

	@mysqli_query($connect, $sql);
	if (mysqli_error($connect)) {
		//echo "MySQL Error: ".mysqli_error($connect)."</br>";
		//echo "SQL = \"". $sql . "\"";
		return 0;
	} else {
		return mysqli_insert_id($connect);
	}
}




function list_records($sensor_id){
	global $connect;

	$sql = "SELECT * FROM records WHERE sensor_id = $sensor_id ORDER BY date_insert DESC LIMIT 30;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	} else {
		return $result;
	}
}


?>