//Предлагаю этот файл оставить для общих скриптов в проекте
//А для пользователей создать отдельный файл users.js


//=====================Пользователь=====================

//Удаление пользователя 
// $(document).on('click','#btndeleteuser', function () {
// 	var user_id = $(this).attr('data-user-id');
// 	var user_name = $(this).attr('data-user-name');
// 	$('#deleteUserQuestion').html('Вы действительно хотите удалить группу: '+
//   	'<b>' + user_name + '</b>?');
//   	$(document).on('click','#btnDeleteUser', function (e){
//   		$.get('/?page=deleteuser&id='+user_id, function(data){
// 		console.log(data);
// 		alert('Delete!');
// 		$('#deluserModal').modal('hide'); //Прячем окно
//   		alert(user_id);
// 		});
//   	});
// });
// $('#deluserModal').on('show.bs.modal', function(e){
// 		var user_id = $(e.relatedTarget).data('user-id');
// 		var user_name = $(e.relatedTarget).data('user-name');
// 		//alert('Delete sensor: '+sensor_num);
// 		$('#deleteUserQuestion').html('<b>'+user_name+'</b>');
// 		$('#del_sensor_button').data('user_id ', user_id);
// 	});
// $('#btndeleteuser').on('click', function () {
// 	alert("asd");
// 	var user_id = $(this).attr('data-user-id');
// 	var user_name = $(this).attr('data-user-name');
// 	$('#deleteUserQuestion').html('Вы действительно хотите удалить группу: '+
//   	'<b>' + user_name + '</b>?');
//   	$(document).on('click','#btnDeleteUser', function (e){
//   		$.get('/?page=deleteuser&id='+user_id, function(data){
// 		console.log(data);
// 		alert('Delete!');
// 		$('#deluserModal').modal('hide'); //Прячем окно
//   		alert(user_id);
// 		});
//   	});
// });



//Добаление нового пользователя
// $(document).on('click','#btnAddUser', function (e){
// 	var user_login = $('#add_user_login').val('');
// 	var user_pass = $('#add_user_pass').val('');
// 	var user_email =$('#add_user_email').val('');
// 	var user_level_id = document.getElementById("add_user_level_id").value;
// 		$.get('/?page=adduser', function(data){
// 		console.log(data);
// 		$('#add_user_login').val(data.user_login);
// 		$('#add_user_pass').val(data.user_pass);
// 		$('#add_user_email').val(data.user_email);
// 		$('#add_user_level_id').val(data.user_level_id);
	
// 	$('#adduserModal').modal('hide'); //Прячем окно
// });

// });
