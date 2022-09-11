<?php
	$tpl = new Smarty; //Создание объекта Smarty

	//$tpl->caching = true; //Включаем кэширование

	//$tpl->cache_lifetime = 120;
		// http://myshop/?page-about
	// $tpl->assign('user_info', $user_info);

	// if(isset($_GET['page'])){
	// 	$page = $_GET['page'];
	// 	}
	// 	else{
	// 		$page ='';
	// 	}
		
		
	// if ($user_info) {
	//   //Пользователь авторизован
	//   //Затем проверяем уровень доступа пользователя
	//   if ($user_info['level_id'] == 1) {
	//     //Суперадмин
	//   } elseif ($user_info['level_id'] == 2) {
	//     //Админ
	//   } elseif ($user_info['level_id'] == 3) {
	//     //Пользователь
	//   } elseif ($user_info['level_id'] == 4) {
	//     //Наблюдатель
	//   }
	// }

		
	//Авторизация
	//===================================================
	if ($page == '') {

		$tpl->display('autho.tpl');
		

	
	// Главная страница
	// ===================================================	
	} elseif ($page == 'main'){
		$tpl->display('main.tpl');




	//страница о магазине...
	//===================================================	
	// } elseif ($page == 'about'){
	// 	$tpl->assign('PageTitle', 'О магазине');
	// 	$tpl->assign('Content', $content);
		
	// 	$tpl->display('main.tpl');



	//===================================================	
	

	} 
	 else{
		$content = '<h3> 404 page</h3>';
		$tpl->assign('PageTitle', '404');
		$tpl->assign('Content', $content);
		
		$tpl->display('main.tpl');

	}


?>