//Массив открытых вкладок в окне настроек датчика
//Если вкладку открыли значение 1, если не открывали - 0
var set_visited_tabs = new Map([
	['#sens_settings', 1], //Вкладка открыта сразу
	['#sens_table', 0],
	['#sens_log', 0]
]);

$(document).ready(function(){

	//Обновление таблицы 1 раз в секунду
    setInterval(function(){
		$.get('?page=sensors_table&start='+start_data+'&count='+count_data, function(data) {
			$('.tbody_tablemain').html(data);
		});
    }, 1000);

	//Валидация формы
	$('.add_sensors').validate({
		rules: {
			add_sensor_name: {
				required: true
			},
			add_sensor_number: {
				required: true,
				number: true
			},
			add_sensor_seth: {
				required: true,
				number: true
			},
		},
		messages: {
			add_sensor_name: {
				required: 'Укажите название устройства'
			},
			add_sensor_number: {
				required: 'Укажите заводской номер устройства',
				number: 'Укажите число',
				min: 'Введите число больше 0'
			},
			add_sensor_seth: {
				required: 'Укажите высоту от датчика до дна в см',
				number: 'Укажите число'
			},
		},
		submitHandler: function(form) {
			var str_ser = $(form).serialize();
			console.log(str_ser);
			$.get('?page=addsensor&'+str_ser, function(data){
				console.log('Result: '+data.result);
				if (data.result == 'OK') {
					//выведем уведомление о успешном добавлении
					toastr.success('Датчик добавлен!');
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




	//Валидация формы редактирования настроек датчика
	$('.set_sensors').validate({
		rules: {
			set_sensor_name: {
				required: true
			},
			set_sensor_seth: {
				required: true,
				number: true
			},
		},
		messages: {
			set_sensor_name: {
				required: 'Укажите название устройства'
			},
			set_sensor_seth: {
				required: 'Укажите высоту от датчика до дна в см',
				number: 'Укажите число'
			},
		},
		submitHandler: function(form) {
			var str_ser = $(form).serialize();
			console.log(str_ser);
			$.get('?page=updsensor&'+str_ser, function(data){
				console.log('Result: '+data.result);
				if (data.result == 'OK') {
					//выведем уведомление о успешном добавлении
					toastr.success('Настройки датчика сохранены!');
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







	//Открытие окна добавления нового датчика
	$('#addSensorsModal').on('show.bs.modal', function(e){
		//alert("Add Sensor modal open!");
		//Очистим ошибки
		$('.is-invalid').removeClass('is-invalid');
		$('#add_sensor_name').val('');
		$('#add_sensor_number').val('');
		$('#add_sensor_description').val('');
		$('#add_sensor_phone').val('');
		$('#add_sensor_seth').val('');
	});

	//Открытие окна удаления датчика
	$('#delSensorsModal').on('show.bs.modal', function(e){
		var sensor_num = $(e.relatedTarget).data('sensor-num');
		var sensor_name = $(e.relatedTarget).data('sensor-name');
		//alert('Delete sensor: '+sensor_num);
		$('.del_sensor_name').html('<b>'+sensor_name+'</b>');
		$('#del_sensor_button').data('sensor-num', sensor_num);
	});

	//Нажали кнопку удаления в модальном окне удаления датчика
	$('#del_sensor_button').on('click', function(){
		var sensor_num = $(this).data('sensor-num');
		//alert('Delete sensor num: '+sensor_num);
		$.get('?page=delsensor&sensor_num='+sensor_num, function(data){
			console.log('Result: '+data.result);
			if (data.result == 'OK') {
				//выведем уведомление о успешном добавлении
				toastr.success('Датчик удален!');
			} else {
				//выведем сообщение об ошибке
				toastr.error(data.error);
			}
			//Закроем модальное окно
			$('.modal').modal('hide');
		}, 'json');

	});



	//Открытие окна настроек датчика
	$('#setSensorsModal').on('show.bs.modal', function(e){
		var sensor_num = $(e.relatedTarget).data('sensor-num');
		console.log('Settings sensor: '+sensor_num);
		//$('#del_sensor_button').data('sensor-num', sensor_num);

		//Сброс массива открытых вкладок на значение по умолчанию
		for (let key of set_visited_tabs.keys()) {
			set_visited_tabs.set(key, 0);
		}
		set_visited_tabs.set('#sens_settings', 1);

		$('.is-invalid').removeClass('is-invalid');

		//Раз открыта первая вкладка, то запросим информацию о нужном датчике
		$.get('?page=getsensor&sensor_num='+sensor_num, function(data){
			console.log('Result Json:');
			console.log(JSON.stringify(data));
			//Обновим все поля 1й вкладки
			$('#set_sensor_name').val(data.name);
			$('#set_sensor_number').val(data.factorynumber);
			$('#set_sensor_description').val(data.description);
			$('#set_sensor_phone').val(data.gsmnum);
			$('#set_sensor_seth').val(data.high);
			var date_slice = data.start_work.split(' ');
			$('#set_sensor_start').val(date_slice[0]);
			console.log('Split date: '+date_slice[0]);
		}, 'json');

	});




	//Переключение вкладок в окне настроек датчика
	$('a[data-bs-toggle="pill"]').on('show.bs.tab', function(e){
		var new_tab = e.target.hash;
		console.log('new_tab = '+new_tab);

		//Если вкладку не открывали вообще
		if (!set_visited_tabs.get(new_tab)) {
			console.log('New tab: '+new_tab);

			//Выполняем действия в зависимости от открытой вкладки
			switch (new_tab) {
				case '#sens_table':
					console.log('Sensor Table tab!');
					break;
				case '#sens_log':
					console.log('Sensor Log tab!');
					break;
			}
			set_visited_tabs.set(new_tab, 1);
		}
	});

});