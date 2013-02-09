<?php

return array(

    // Работа с серверами MEMCACHED
    '{^/server/$}' => array('memcache', 'index'),
    '{^/server/status/$}' => array('memcache', 'status'),
    '{^/server/view/$}' => array('memcache', 'view'),
    '{^/server/update/$}' => array('memcache', 'update'),
    '{^/server/delete/$}' => array('memcache', 'delete'),

    // Основные компоненты приложения
    '{^/settings/$}' => array('settings', 'index'),
    '{^/help/$}' => array('help', 'index'),
);
