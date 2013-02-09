<?php

require 'classes' . '/' . 'Cache.inc.php';
//require 'classes' . '/' . 'CacheFile.inc.php';
//require 'classes' . '/' . 'CacheFileCollect.inc.php';
require 'classes' . '/' . 'CacheMemory.inc.php';
require 'classes' . '/' . 'CacheMemoryCollect.inc.php';
require 'classes' . '/' . 'View.inc.php';
require 'classes' . '/' . 'I18n.php';
require 'classes' . '/' . 'Config.php';

// Config

Config::load('memcache');
Config::load('i18n');

// Init

$lang = Config::get('i18n.lang');

I18n::load( $lang );
I18n::lang( $lang );

// Static MVC singleton ;)

require 'controller' . '/' . 'memcache.php';

$controller = new Controller_Memcache;

$parts = explode('/', $_SERVER['REQUEST_URI']);
$action = $parts[1];

if ( !method_exists($controller, $action ) ) {
    $action = 'index';
}

call_user_func( array($controller, $action) );
