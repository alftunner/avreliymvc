<?php

namespace vendor\core;

/**
 * Класс для подключения к базе данных
 */
class DB
{

    /**
     * @var \PDO свойство для хранения объекта PDO
     */
    protected $pdo;

    /**
     * @var self свойство для хранения объекта класса DB
     */
    protected $instance;

    protected function __construct() {
        $db = require ROOT . '/config/config_db.php';
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass']);
    }


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

    /**
     * Метод для выполнения запроса типа insert
     * @param $sql
     * @return bool
     */
    public function execute($sql) {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();
    }


    /**
     * Метод для выполнения запроса типа select
     * @param $sql
     * @return array|false
     */
    public function query($sql) {
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute();
        if ($res !== false) {
            return $stmt->fetchAll();
        }
        return [];
    }
}