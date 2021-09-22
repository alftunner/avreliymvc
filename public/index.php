<?php

$query = rtrim($_SERVER['QUERY_STRING'], '/');

require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';
require '../app/controllers/Main.php';
require '../app/controllers/Posts.php';

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$'); // создаёт именованные ключи для совпадений с регулярками

Router::dispatch($query);

