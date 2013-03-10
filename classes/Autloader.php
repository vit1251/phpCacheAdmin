<?php

function import($className) {
    $classPath = explode('_', $className);
    $path = dirname(__FILE__) . '/' . join('/', $classPath) . '.php';
    if (file_exists($path)) {
        include $path;
    }
}
spl_autoload_register('import');


// Hardcoded autoload
class_exists('View');
class_exists('Controller');
class_exists('ControllerTemplate');
class_exists('Request');
class_exists('I18n');
class_exists('Config');
class_exists('Cache');
//class_exists('CacheFile');
//class_exists('CacheFileCollect');
class_exists('CacheMemory');
class_exists('CacheMemoryCollect');
class_exists('Application');
