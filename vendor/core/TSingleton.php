<?php

namespace vendor\core;

trait TSingleton
{
    /**
     * @var self свойство для хранения объекта класса
     */
    protected static $instance;

    /**
     * метод для создания инстанса
     * @return DB
     */
    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}