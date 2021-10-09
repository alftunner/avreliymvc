<?php

namespace vendor\core\base;

use vendor\core\DB;

/**
 *Базовый класс модели
 */
abstract class Model
{
    /**
     * @var \PDO свойство для хранения объекта PDO
     */
    public $pdo;
    /**
     * @var string свойство для хранения имени таблицы
     */
    public $table;

    public function __construct() {
        $this->pdo = DB::instance();
    }

    public function query($sql) {
        return $this->pdo->execute($sql);
    }

    public function findAll() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }
}