<?php

$query = rtrim($_SERVER['QUERY_STRING'], '/');

require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';

Router::add('posts/add', [
    'controller' => 'Posts',
    'action' => 'add'
]);
Router::add('posts/', [
    'controller' => 'Posts',
    'action' => 'index'
]);
Router::add('', [
    'controller' => 'Main',
    'action' => 'index'
]);

if (Router::matchRoute($query)) {
    showMeArr(Router::getCurrentRoute());
} else {
    echo '404';
}
