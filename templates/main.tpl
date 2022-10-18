<!DOCTYPE html>
<html lang="ru">
<head>
	{include file='head.tpl'}
</head>
<body>
  {include file='header.tpl'}
  <div class="container-fluid" style="padding-left: calc(var(--bs-gutter-x) )">
    <div class="row">
		{include file='aside.tpl'}
      	<div class="col-md-9">
      		{eval $Content}
      	</div>
    </div>
  </div>
  <footer class="footer">
	{include file='footer.tpl'}
  </footer>
</body>
</html>