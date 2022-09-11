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

	$sql = "SELECT * FROM users WHERE login = '$login' AND pass = '$password'";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	} else {
		$res_arr = mysqli_fetch_assoc($result);
		$_SESSION['id'] = $res_arr['id'];
		usertimeupdate($res_arr['id']);
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

// function usertimeupdate($user_id){
// 	global $connect;

// 	$sql = "UPDATE users SET date_login = NOW() WHERE id = ".$user_id;
// 	$result = @mysqli_query($connect, $sql);
// 	if (!$result) {
// 		echo "MySQL Error: ".mysqli_error($connect)."</br>";
// 		echo "SQL = \"". $sql . "\"";
// 	}
// }

?>