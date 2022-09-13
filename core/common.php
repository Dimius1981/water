<?php
	// 	$path = './templates/';
		
	//Проверка на авторизацию
	print_r($_POST);
	if ((!empty($_POST['login'])) && (!empty($_POST['password']))){
		echo "Authorization\n";
		authorization($_POST['login'], $_POST['password']);
		header('location: https://google.kz');
		} 
	
	//Запрос информации
	if (!isset($_SESSION['id'])) {
		$session_id = -1;

	} else{
		$session_id = $_SESSION['id'];
	}
	

	$user_info = userinfo($session_id);

// if ($user_info) { 
// 		$login_time_unix = strtotime($user_info['date_login']);

// 		$user_time = $cur_time_unix - $login_time_unix;


// 		//Проверка на выход пользователя
// 		if ((isset($_GET['logout'])) || ($user_time > $TIME_LIVE)) {
// 			session_destroy();
// 			header('Location: ./', true, 301); //После выхода перенаправляемся на главную страницу
// 		} else {
// 			usertimeupdate($session_id);
// 		}
// 	}


	//Главная страница
	//===================================================
	if ($page == '') {
		
		
		




	// //Магазине...
	// //===================================================	
	} elseif ($page == 'main'){
		

	


	} else{
		$content = '<h3> 404 page</h3>';
	
	}
?>

