<?php

namespace vendor\core;

class Registry
{
    public static $objects = [];
    protected static $instance;

    protected function __construct()
    {
        require_once ROOT . '/config/config.php';
        foreach ($config['components'] as $name => $component) {
            self::$objects[$name] = new $component;
        }
    }

    public function __get($name) {
        if (is_object(self::$objects[$name])) {
            return self::$objects[$name];
        }
    }

    public function __set($name, $value) {
        if (!isset(self::$objects[$name])) {
            self::$objects[$name] = new $value;
        }
    }

    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getList() {
        echo '<pre>';
        var_dump(self::$objects);
        echo '</pre>';
    }
}