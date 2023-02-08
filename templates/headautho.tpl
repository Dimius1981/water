  <meta charset="UTF-8">
  <title>authorization</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./templates/css/reset.min.css">
  <link rel="stylesheet" href="./templates/css/styleautho.css">
  <script src="templates/js/jquery-3.6.0.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#autho').on('click', function(){
        //alert('Click Autorization!');
            var data = new FormData();
            data.append('login', 'admin');
            data.append('password', 'admin');
            //data.append('auth', true);
            // AJAX запрос
            $.ajax({
                url         : 'login.php?auth=1',
                type        : 'POST', // важно!
                data        : data,
                cache       : false,
                dataType    : 'json',
                // отключаем обработку передаваемых данных, пусть передаются как есть
                processData : false,
                // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
                contentType : false,
                // функция успешного ответа сервера
                success     : function( respond, status, jqXHR ){

                    // ОК - запрос выполнен успешно
                    if( typeof respond.error === 'undefined' ){
                        // выведем пути загруженных файлов в блок '.ajax-reply'
                        console.log('OK: ' + respond.result);

                    }
                    // ошибка
                    else {
                        console.log('ОШИБКА: ' + respond.error );

                        // Сообщение из POST запроса
                        console.log('LOG: ' + status, jqXHR );
                    };
                },
                // функция ошибки ответа сервера
                error: function( jqXHR, status, errorThrown ){
                    console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
                }

            });






      });
    });
  </script>