<?php

namespace vendor\core;

use R;

/**
 * Класс для подключения к базе данных
 */
class DB
{
    use TSingleton;
    protected function __construct() {
        $db = require ROOT . '/config/config_db.php';
        require LIBS . '/rb-mysql.php';
        $db = require '../config/config_db.php';
        R::setup($db['dsn'], $db['user'], $db['pass']);
        R::freeze(true);
    }
}