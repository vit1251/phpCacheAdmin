<?php

require 'classes' . '/' . 'ErrorHandler.inc.php';

require 'classes' . '/' . 'View.inc.php';
require 'classes' . '/' . 'Controller.inc.php';
require 'classes' . '/' . 'ControllerTemplate.inc.php';

require 'classes' . '/' . 'Request.inc.php';

require 'classes' . '/' . 'I18n.php';
require 'classes' . '/' . 'Config.php';

require 'classes' . '/' . 'Cache.inc.php';
//require 'classes' . '/' . 'CacheFile.inc.php';
//require 'classes' . '/' . 'CacheFileCollect.inc.php';
require 'classes' . '/' . 'CacheMemory.inc.php';
require 'classes' . '/' . 'CacheMemoryCollect.inc.php';

require 'classes' . '/' . 'Application.inc.php';

// ѕроисходит загрузка, исполнение, отправка заголовков и вывод шаблонов
Application::createApplication()->run();
