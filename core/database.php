<?php
// Подключение к базе данных
$connect = @mysqli_connect($HOST_DB, $USER_DB, $PASS_DB, $NAME_DB);


if (mysqli_connect_errno()){
	echo 'ERROR: '.mysqli_connect_errno();
	exit();
}


?>