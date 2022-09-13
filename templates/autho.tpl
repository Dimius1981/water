<!DOCTYPE html>
<html>

<head>
  {include file='headautho.tpl'}
</head>

<body>
  <form class='login-form' method="post">
    <div class="flex-row logo">
      <h1>LOGO</h1>
    </div>
    <div class="flex-row">
      <input id="username" class='lf--input form-control' placeholder='Логин' type='text' id="user-name" name="login" required>
    </div>
    <div class="flex-row">
      <input id="password" class='lf--input form-control' placeholder='Пароль' type='password' id="user-password" name="passwword" required>
    </div>
    <button class='lf--submit' type='submit'>Войти</button>
    <a class='lf--forgot' href='#'>Забыли пароль?</a>
  </form>

</body>

</html>