$(document).ready(function(){

	//Обновление таблицы 1 раз в секунду
    setInterval(function(){
		$.get('?page=sensors_table', function(data) {
			$('.tbody_tablemain').html(data);
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
});