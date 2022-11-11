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
  {if $func_access[1]}
    {include file ='modaldelete.tpl'}
    {include file ='modaladd.tpl'}
  {/if}
  {if $func_access[2]}
    {include file ='modalsettind.tpl'}
  {/if}
  {if $func_access[5]}
    {include file ='modaladdfile.tpl'}
  {/if}
{/if}

{if $page == "users"}
  {if $func_access[3]}
    {include file ='modaladduser.tpl'}
    {include file ='modaldeluser.tpl'}
    {include file ='modaledituser.tpl'}
  {/if}
{/if}

</body>

</html>