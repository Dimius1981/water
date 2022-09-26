<!DOCTYPE html>
<html lang="ru">
<head>
	{include file='head.tpl'}
</head>
<body>
	{include file='header.tpl'}
	<div class="row">
	{include file='aside.tpl'}
	{eval $Content}
	</div>
	{include file='footer.tpl'}
</body>
</html>