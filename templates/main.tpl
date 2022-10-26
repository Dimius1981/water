<!DOCTYPE html>
<html lang="ru">

<head>
  {include file='head.tpl'}
</head>

<body>
  <div class="wrapper">
    {include file='header.tpl'}

    <div class="content">
      {eval $Content}

    </div>

    <footer class="footer">
      {include file='footer.tpl'}
    </footer>
{include file ='modaldelete.tpl'}
{include file ='modaladd.tpl'}
{include file ='modalsettind.tpl'}
{include file ='modaladduser.tpl'}
{include file ='modaldeluser.tpl'}
{include file ='modaledituser.tpl'}
  </div>

</body>

</html>