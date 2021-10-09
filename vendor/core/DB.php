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
    protected static $instance;

    /**
     * @var int счётчик запросов к базе
     */
    public static $counterQueries = 0;

    /**
     * @var array массив для хранения запросов
     */
    public static $queries = [];

    protected function __construct() {
        $db = require ROOT . '/config/config_db.php';
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);
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
        self::$counterQueries++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();
    }


    /**
     * Метод для выполнения запроса типа select
     * @param $sql
     * @return array|false
     */
    public function query($sql) {
        self::$counterQueries++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute();
        if ($res !== false) {
            return $stmt->fetchAll();
        }
        return [];
    }
}