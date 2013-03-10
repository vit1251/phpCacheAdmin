<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <style>
        body {
            padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>
    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="#">phpCacheAdmin</a>
            <div class="nav-collapse collapse">
                <ul class="nav">

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo I18n::get('mainmenu.server') ?></a>
        <ul class="dropdown-menu">
            <li><a href="?controller=memcache"><?php echo I18n::get('mainmenu.servermenu.nodes') ?></a></li>
            <li><a href="?controller=memcache&action=status"><?php echo I18n::get('mainmenu.servermenu.status') ?></a></li>
        </ul>
    </li>

    <li><a href="?controller=settings"><?php echo I18n::get('mainmenu.settings') ?></a></li>
    <li><a href="?controller=help"><?php echo I18n::get('mainmenu.help') ?></a></li>

                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container">
     <div class="row">
         <div class="span12">
<?php echo isset($content) ? $content : 'Ooops...'; ?>
         </div>
     </div>
</div>

<div class="footer">
    &copy; Vitold Sedyshev Research
</div>

</body>
</html>
