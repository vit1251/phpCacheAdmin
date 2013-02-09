<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
	<script type="text/javascript" src="/js/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="/js/jquery.blockUI.js"></script>
</head>
<body>

<div id="top" style="margin-bottom: 10px">
    <span style="float: left"><a href="/"><?php echo I18n::get('catalog') ?></a></span>
    <span style="float: right"><a href="/gc.php"><?php echo I18n::get('gc') ?></a></span>
</div>

<?php echo $content ?>

</body>
</html>