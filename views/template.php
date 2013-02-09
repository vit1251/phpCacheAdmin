<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
	<link rel="stylesheet" type="text/css" href="/css/menu.css" media="all" />
	<script type="text/javascript" src="/js/jquery-1.4.4.min.js"></script>
</head>
<body>

<div id="mainmenu">

<ul class="menu">

    <li><a href="/"><?php echo I18n::get('mainmenu.general') ?></a></li>

    <li>
        <a href="#"><?php echo I18n::get('mainmenu.server') ?></a>
        <ul>
            <li><a href="/server/"><?php echo I18n::get('mainmenu.servermenu.nodes') ?></a></li>
            <li><a href="/server/status/"><?php echo I18n::get('mainmenu.servermenu.status') ?></a></li>
        </ul>
    </li>

    <li><a href="/settings/"><?php echo I18n::get('mainmenu.settings') ?></a></li>
    <li><a href="/help/"><?php echo I18n::get('mainmenu.help') ?></a></li>

</ul>

</div>

<div style="clear: both;"></div>

<div class="content">

<?php if ( !isset($content) ) {
    echo new View('error');
} else {
    echo $content;
}
?>

</div>

</body>
</html>