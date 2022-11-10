//Функция для обнавления таблицы пользователей
function update_user_table() {
	$.get('?page=users_table', function(data) {
		$('.tbody_userstable').html(data);
	});
}

//В начале скрипта нужно открыть функцию которая выполнится только после загрузки всей страницы
$(document).ready(function(){

update_user_table();

//Здесь объявлеяем все обработчики
	//Валидация формы
	$('.add_users').validate({
		rules: {
			add_user_name: {
				required: true
			},
			add_user_login: {
				required: true
			},
			add_user_pass: {
				required: true
			},
			add_user_email: {
				required: true
			}
		},
		messages: {
			add_user_name: {
				required: 'Укажите имя пользователя'
			},
			add_user_login: {
				required: 'Укажите login пользователя'
			},
			add_user_pass: {
				required: 'Укажите пароль пользователя'
			},
			add_user_email: {
				required: 'Укажите email пользователя'
			}
		},
		submitHandler: function(form) {
			//Здесь мы собираем данные со всех полей формы
			var str_ser = $(form).serialize();
			console.log(str_ser); //Выводим в консоль для диагностики
			//Теперь выполним запрос get для добавления нового пользователя
			$.get('?page=adduser&'+str_ser, function(data){
				console.log('Result: '+data.result);
				if (data.result == 'OK') {
					//выведем уведомление о успешном добавлении
					toastr.success('Пользователь успешно добавлен!');

					update_user_table();
				} else {
					//выведем сообщение об ошибке
					toastr.error(data.error);
				}
				//Закроем модальное окно
				$('.modal').modal('hide');
			}, 'json');
		},
		errorElement: 'span',
		errorPlacement: function (error, element) {
			error.addClass('invalid-feedback');
			element.closest('.form-group').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass('is-invalid');
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}
	});



	//Валидация формы редактирования информации о пользователе
	$('.edit_users').validate({
		rules: {
			edit_user_name: {
				required: true
			},
			edit_user_login: {
				required: true
			},
			
			edit_user_email: {
				required: true
			}
		},
		messages: {
			edit_user_name: {
				required: 'Укажите имя пользователя'
			},
			edit_user_login: {
				required: 'Укажите login пользователя'
			},
			
			edit_user_email: {
				required: 'Укажите email пользователя'
			}
		},
		submitHandler: function(form) {
			//Здесь мы собираем данные со всех полей формы
			var str_ser = $(form).serialize();
			console.log(str_ser); //Выводим в консоль для диагностики
			//Теперь выполним запрос get для добавления нового пользователя
			$.get('?page=upduser&'+str_ser, function(data){
				console.log('Result: '+data.result);
				if (data.result == 'OK') {
					//выведем уведомление о успешном добавлении
					toastr.success('Информация о пользователе успешно изменена!');
					update_user_table();
				} else {
					//выведем сообщение об ошибке
					toastr.error(data.error);
				}
				//Закроем модальное окно
				$('.modal').modal('hide');
			}, 'json');
		},
		errorElement: 'span',
		errorPlacement: function (error, element) {
			error.addClass('invalid-feedback');
			element.closest('.form-group').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass('is-invalid');
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}
	});


	$('#adduserModal').on('show.bs.modal', function(e){
		//alert('Add new user!');
		//Очистим ошибки
		$('.is-invalid').removeClass('is-invalid');
		//Очистим все поля
		$('#add_user_name').val('');
		$('#add_user_login').val('');
		$('#add_user_pass').val('');
		$('#add_user_email').val('');

	});


	//Открытие окна удаления пользователя
	$('#deluserModal').on('show.bs.modal', function(e){
		var user_id = $(e.relatedTarget).data('user-id');
		var user_name = $(e.relatedTarget).data('user-name');
		$('#deleteUserQuestion').html('Вы действительно хотите удалить пользователя: '+'<b>' + user_name + '</b>?');
		//alert('Delete user: '+user_id);
		$('#del_user_button').data('user-id', user_id);
	});

	// Нажали кнопку удаления в модальном окне удаления пользователя
	$('#del_user_button').on('click', function(){
		var user_id = $(this).data('user-id');
		$.get('?page=deleteuser&user_id='+user_id, function(data){
			console.log('Result: '+data.result);
			if (data.result == 'OK') {
				//выведем уведомление о успешном добавлении
				toastr.success('Пользователь удален!');
				update_user_table();
			} else {
				//выведем сообщение об ошибке
				toastr.error(data.error);
			}
			//Закроем модальное окно
			$('.modal').modal('hide');
		}, 'json');
	});

	//Открытие окна настроек датчика
	$('#edituserModal').on('show.bs.modal', function(e){
		var user_id = $(e.relatedTarget).data('user-id');
		console.log('Update user: '+user_id);

		$('.is-invalid').removeClass('is-invalid');

		//Раз открыта первая вкладка, то запросим информацию о нужном пользователе
		$.get('?page=getuser&user_id='+user_id, function(data){
			
			var enabled = data.enabled;
			if (enabled == "1") {
					$('#edit_user_enabled').prop('checked', true);
					$('#edit_user_enabled').val("1");
					$('#edit_user_enabled').on('click', function(){
					if($(this).is(":checked")){
						$('#edit_user_enabled').val("1");
					} else {
						$('#edit_user_enabled').val("0");
					}	
					});
				} else {
					$('#edit_user_enabled').prop("checked", false);
					$('#edit_user_enabled').val("0");
					$('#edit_user_enabled').on('click', function(){
					if($(this).is(":checked")){
						$('#edit_user_enabled').val("1");
					} else {
						$('#edit_user_enabled').val("0");
					}	
					});
				}
			
			console.log('Result Json:');
			console.log(JSON.stringify(data));
			//Обновим все поля 1й вкладки
			$('#edit_user_id').val(data.id);
			$('#edit_user_name').val(data.name);
			$('#edit_user_login').val(data.login);
			$('#edit_user_level_id').val(data.level_id);
			$('#edit_user_email').val(data.email);
			$('#edit_user_enabled').val(data.enabled);
			$('#edit_user_pass').val('');
		}, 'json');

	});

});
