//Массив открытых вкладок в окне настроек датчика
//Если вкладку открыли значение 1, если не открывали - 0
var set_visited_tabs = new Map([
	['#sens_settings', 1], //Вкладка открыта сразу
	['#sens_table', 0],
	['#sens_log', 0]
]);

var count_rec_table = 1;
var checked_rows = [];
var sensor_num = 0;

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
			if (form.iseditsettings.value == 1) {
				//alert('Save Settings!');
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
			} else if (form.isedittable.value == 1) {
				//alert('Save Table!');
				$.get('?page=updlevelrashod&'+str_ser, function(data){
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
			} else {
				//выведем сообщение об ошибке
				toastr.error('Настройки не были изменены!');
				//Закроем модальное окно
				$('.modal').modal('hide');
			}
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
		sensor_num = $(e.relatedTarget).data('sensor-num');
		console.log('Settings sensor: '+sensor_num);
		//$('#del_sensor_button').data('sensor-num', sensor_num);

		//Сброс массива открытых вкладок на значение по умолчанию
		for (let key of set_visited_tabs.keys()) {
			set_visited_tabs.set(key, 0);
		}
		set_visited_tabs.set('#sens_settings', 1);
		$('.nav-pills a[href="#sens_settings"]').tab('show');

		$('.is-invalid').removeClass('is-invalid');

		$('input[name="iseditsettings"]').val(0);
		$('input[name="isedittable"]').val(0);

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

					count_rec_table = 1;

					//Очистим строк таблицы
		      		$('.trow').each(function(index, el) {
		      			if ($(".trow").length > 1) {
	      					$(el).find(':input').off();
	      					$(el).remove();
	      				} else {
	      					$(el).find(':input').val('');
							$(el).find(':checkbox').prop('checked', false).val(count_rec_table);
							$(el).find('.num_rec').html(count_rec_table);
	      				}
	      			});

					//Загрузим данные для таблицы
					$.get('?page=listlevelrashod&sensor_num='+sensor_num, function(data){
						console.log('Result Json:');
						console.log(JSON.stringify(data));

						//Заполним таблицу
						$.each(data, function(idx, elem){
							console.log(idx+": "+JSON.stringify(elem));
		if (idx == 0) {
			var template = $("tr.trow:first");
			template.find(':checkbox').prop('checked', false).val(count_rec_table);
			template.find('input[name="level_num_row[]"]').val(elem.level);
			template.find('input[name="rashod_num_row[]"]').val(elem.rashod);
			template.find('.num_rec').html(count_rec_table);
		} else {
			count_rec_table++;
			var template = $("tr.trow:first");
			var newRow = template.clone();
			newRow.find(':checkbox').prop('checked', false).val(count_rec_table);
			newRow.find('input[name="level_num_row[]"]').val(elem.level);
			newRow.find('input[name="rashod_num_row[]"]').val(elem.rashod);
			newRow.find('.num_rec').html(count_rec_table);
			newRow.find(':input').on('change', function() {
				//alert('Change!');
				$('input[name="isedittable"]').val(1);
			});
			var lastRow = $("tr.trow:last").after(newRow);
		}
						});

					}, 'json');

					break;
				case '#sens_log':
					console.log('Sensor Log tab!');
					break;
			}
			set_visited_tabs.set(new_tab, 1);
		}
	});


	$('#btn_table_add').on('click', function(){
		//alert('btn_table_add');
		count_rec_table++;
		var template = $("tr.trow:first");
		var newRow = template.clone();
		newRow.find(':input').val('');
		newRow.find(':checkbox').prop('checked', false).val(count_rec_table);
		newRow.find('.num_rec').html(count_rec_table);

		newRow.find(':input').on('change', function() {
			//alert('Change!');
			$('input[name="isedittable"]').val(1);
		});

		var lastRow = $("tr.trow:last").after(newRow);
	});

	$('#btn_table_del').on('click', function(){
		//alert('btn_table_del');
		checked_rows = [];
		$('input[name="cb_row"]:checked').each(function() {
        	checked_rows.push($(this).val());
      	});
      	console.log('checked_rows: '+checked_rows);
      	if (checked_rows.length == 0) {
      		toastr.error('Нужно выбрать хотябы одну строку!');
      	} else {
      		//Удалим строки
      		$.each(checked_rows, function(rows_idx, rows_val){
      			console.log('idx: '+rows_idx+', val: '+rows_val);

	      		$('.trow').each(function(index, el) {
	      			console.log($(el).find(':checkbox').val());

	      			if ($(el).find(':checkbox').val() == rows_val) {
	      				if ($(".trow").length > 1) {
	      					$(el).find(':input').off();
	      					$(el).remove();

	      					return false;
	      				} else {
	      					$(el).find(':input').val('');
	      				}
	      			}
	      		});
      		});

			//Перенумеруем строки
			count_rec_table = 0;
			$('.trow').each(function(index, el) {
				count_rec_table++;
				$(el).find(':checkbox').prop('checked', false).val(count_rec_table);
				$(el).find('.num_rec').html(count_rec_table);
			});

  			$('input[name="tbl_sel_all"]').prop('checked', false);
			$('input[name="isedittable"]').val(1);

			toastr.success('Строки успешно удалены!');
      	}
	});

	$('#btn_table_clear').on('click', function(){
		//alert('btn_table_clear');
		count_rec_table = 0;
		$('.trow').each(function(index, el) {
			count_rec_table++;
			$(el).find(':input').val('');
			$(el).find(':checkbox').prop('checked', false).val(count_rec_table);
			$(el).find('.num_rec').html(count_rec_table);
		});
	});

	$('input[name="tbl_sel_all"]').change(function(){
		var all_check = $(this).prop('checked');
		$('input[name="cb_row"]').each(function() {
		    if (all_check) {
		    	$(this).prop('checked', true);
		    } else {
		    	$(this).prop('checked', false);
		    }
		});
	});



	$('#set_sensor_name').on('change', function() {
		//alert('Change!');
		$('input[name="iseditsettings"]').val(1);
	});

	$('#set_sensor_description').on('change', function() {
		//alert('Change!');
		$('input[name="iseditsettings"]').val(1);
	});

	$('#set_sensor_phone').on('change', function() {
		//alert('Change!');
		$('input[name="iseditsettings"]').val(1);
	});

	$('#set_sensor_seth').on('change', function() {
		//alert('Change!');
		$('input[name="iseditsettings"]').val(1);
	});

	$('#set_sensor_start').on('change', function() {
		//alert('Change!');
		$('input[name="iseditsettings"]').val(1);
	});

	$('input[name="level_num_row"]').on('change', function() {
		//alert('Change!');
		$('input[name="isedittable"]').val(1);
	});

	$('input[name="rashod_num_row"]').on('change', function() {
		//alert('Change!');
		$('input[name="isedittable"]').val(1);
	});

});