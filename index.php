<?php

require dirname(__FILE__) . '/classes/Autloader.php';

// ѕроисходит загрузка, исполнение, отправка заголовков и вывод шаблонов
Application::createApplication()->run();
