<?php
	$tpl = new Smarty; //Создание объекта Smarty

	//$tpl->caching = true; //Включаем кэширование

	//$tpl->cache_lifetime = 120;
		// http://myshop/?page-about
	$tpl->assign('user_info', $user_info);

	if(isset($_GET['page'])){
		$page = $_GET['page'];
		}
		else{
			$page ='';
		}
		
		}
if ($user_info) {
  //Пользователь авторизован
  //Затем проверяем уровень доступа пользователя
  if ($user_info['level_id'] == 1) {
    //Администратор
  } elseif ($user_info['level_id'] == 2) {
    //Управляющий
  } elseif ($user_info['level_id'] == 3) {
    //Менеджер
  } elseif ($user_info['level_id'] == 4) {
    //Покупатель
  }
} else {
  //Это гость
}

		
	//Главная страница
	//===================================================
	if ($page == '') {
		$tpl->assign('PageTitle', 'Акционные товары');
		$tpl->assign('Content', $content);

	


	//страница о магазине...
	//===================================================	
	} elseif ($page == 'about'){
		$tpl->assign('PageTitle', 'О магазине');
		$tpl->assign('Content', $content);
		
		$tpl->display('main.tpl');



	//===================================================	
	

	}  else{
		$content = '<h3> 404 page</h3>';
		$tpl->assign('PageTitle', '404');
		$tpl->assign('Content', $content);
		
		$tpl->display('main.tpl');

	}


?>