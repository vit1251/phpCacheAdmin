<?php

return array(
    'mainmenu' => array(
        'general' => 'Главная',
        'server' => 'Подключение',
        'status' => 'Информация',
        'settings' => 'Настройки',
        'help' => 'Справка',

        'servermenu' => array(
            'nodes' => 'Список записей',
            'status' => 'Статистика',
        ),

    ),

    'server' => array(

        'nodes' => array(
            'name' => 'Название',
            'slab' => 'Куст',
            'size' => 'Размер',
            'date_expire' => 'Дата смерти',
            'timeout' => 'Осталось, сек.',
            'actions' => 'Действия',
        ),

        'status' => array(
            'name' => 'Название переменной',
            'value' => 'Значение'
        ),
    ),

    'settings' => array(
        'languages' => 'Выбор языка',
        'servers' => 'Выбор сервера',

        'language' => array(
            'ru' => 'Русский',
            'en' => 'English',
        ),

        'server' => array(
            'name' => 'Название',
            'host' => 'Адрес узла',
            'port' => 'Порт',
            'timeout' => 'Время доступа',
        ),

    ),


    'action' => array(
        'view' => 'Просмотреть',
        'delete' => 'Удалить',
    ),

    'memcache' => array(
        'stats' => array(
            'pid' => 'Идентификатор процесса',
            'uptime' => 'Время работы',
            'time' => 'Серверное время',
            'version' => 'Версия',
            'pointer_size' => 'Размер указателя',
            'curr_connections' => 'Сервер сейчас обрабатывает подключений',
            'total_connections' => 'Сервер всего обработал подключений',
            'cmd_get' => 'Запросов на загрузку данных',
            'cmd_set' => 'Запросов на сохранение данных',
            'cmd_flush' => 'Запросов на сброс хранилища',
            'get_hits' => 'Успешных запросов на данные',
            'get_misses' => 'Неудачных запросов на данные',
            'limit_maxbytes' => 'Максимальный допустимый размер памяти для хранилища',
            'threads' => 'Количество потоков',
            'curr_items' => 'Текущий узел',
            'total_items' => 'Всего узлов',
        ),
    ),
);
