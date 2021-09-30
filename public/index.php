<?php

use vendor\core\Router;

$query = rtrim($_SERVER['QUERY_STRING'], '/');

const WWW = __DIR__;
define("CORE", dirname(__DIR__) . '/vendor/core');
define("ROOT", dirname(__DIR__));
define("APP", dirname(__DIR__) . '/app');

require '../vendor/libs/functions.php';

//автозагрузка классов
spl_autoload_register(function ($className) {
    $file = ROOT . '/' . str_replace('\\', '/', $className) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

//Собственные правила маршрутизации
Router::add('^pages/?(?P<action>[a-z-]+)?$', ['controller' => 'Posts']);

//Дефолтные правила маршрутизации
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$'); // создаёт именованные ключи для совпадений с регулярками

Router::dispatch($query);

