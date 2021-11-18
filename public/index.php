<?php

use vendor\core\Router;

$query = rtrim($_SERVER['QUERY_STRING'], '/');

const WWW = __DIR__;
define("CORE", dirname(__DIR__) . '/vendor/core');
define("ROOT", dirname(__DIR__));
define("APP", dirname(__DIR__) . '/app');
define("LIBS", dirname(__DIR__) . '/vendor/libs');
define("LAYOUT", 'default');

require '../vendor/libs/functions.php';

//автозагрузка классов
spl_autoload_register(function ($className) {
    $file = ROOT . '/' . str_replace('\\', '/', $className) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

//Собственные правила маршрутизации
Router::add('^page/test$', ['controller' => 'Page', 'action' => 'test']);
Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);

//Дефолтные правила маршрутизации
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$'); // создаёт именованные ключи для совпадений с регулярками

Router::dispatch($query);

