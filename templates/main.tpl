<!DOCTYPE html>
<html lang="ru">

<head>
  {include file='head.tpl'}
</head>

<body>
  <div class="wrapper">
    {include file='header.tpl'}

    <div class="content px-3">
      {eval $Content}
    </div>

    <footer class="footer">
      {include file='footer.tpl'}
    </footer>

  </div>

{if $page == ""}
  {include file ='modaldelete.tpl'}
  {include file ='modaladd.tpl'}
  {include file ='modalsettind.tpl'}
{/if}

{if $page == "users"}
  {include file ='modaladduser.tpl'}
  {include file ='modaldeluser.tpl'}
  {include file ='modaledituser.tpl'}
{/if}

</body>

</html>