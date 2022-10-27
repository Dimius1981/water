$(document).ready(function(){

	// $.get('?page=sensors_table', function(data) {
	// 	$('.tbody_tablemain').html(data);

	// 	//editico_click();
	// });

    setInterval(function(){
		$.get('?page=sensors_table', function(data) {
			$('.tbody_tablemain').html(data);

			//editico_click();
		});
    }, 1000);

	//Валидация формы
	var validator = $('.add_sensors').validate({
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
					//обновим таблицу
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
});