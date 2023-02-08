<!DOCTYPE html>
<html>

<head>
  {include file='headautho.tpl'}
</head>

<body>
  <form class='login-form' method="post">
    <div class="flex-row logo">
      <h1>-=MSD1=-</h1>
    </div>
    <div class="flex-row">
      <input id="username" class='lf--input form-control' placeholder='Логин' type='text' id="user-name" name="login" required>
    </div>
    <div class="flex-row">
      <input id="password" class='lf--input form-control' placeholder='Пароль' type='password' id="user-password" name="password" required>
    </div>
    <button class='lf--submit' type='submit'>Войти</button>
    <!--<button id="autho" class='lf--submit' type='button'>Авторизация</button>-->
    <a class='lf--forgot' href='#'>Забыли пароль?</a>
  </form>

</body>

</html>