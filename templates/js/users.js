//В начале скрипта нужно открыть функцию которая выполнится только после загрузки всей страницы
$(document).ready(function(){

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
});