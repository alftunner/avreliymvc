<?php

namespace vendor\core\base;

use vendor\core\DB;

/**
 * Базовый класс модели
 */
abstract class Model
{
    /**
     * @var \PDO свойство для хранения объекта PDO
     */
    protected $pdo;

    /**
     * @var string свойство для хранения имени таблицы
     */
    protected $table;

    /**
     * @var string свойство для хранения первичного ключа
     */
    protected $primaryKey = 'id';

    public function __construct() {
        $this->pdo = DB::instance();
    }

    /**
     * Метод возвращает bool (выполнился запрос или нет)
     * @param $sql
     * @return bool
     */
    public function query($sql) {
        return $this->pdo->execute($sql);
    }

    /**
     * Метод возвращает все записи
     * @return array|false|\PDOStatement
     */
    public function findAll() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }

    /**
     * метод для выборки одной записи
     * @param $id
     * @param string $field
     * @return array|false|\PDOStatement
     */
    public function findOne($id, $field = '') {
        $field = $field ?: $this->primaryKey;
        $sql = "SELECT * FROM {$this->table} WHERE {$field} = ? LIMIT 1";
        return $this->pdo->query($sql, [$id]);
    }

    /**
     * метод для выборки по произвольному запросу
     * @param $sql
     * @param array $params
     * @return array|false|\PDOStatement
     */
    public function findBySql($sql, $params = []) {
        return $this->pdo->query($sql, $params);
    }

    /**
     * метод для выборки по произвольному запросу с оператором LIKE
     * @param $str
     * @param $field
     * @param string $table
     * @return array|false|\PDOStatement
     */
    public function findLike($str, $field, $table = '') {
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM {$table} WHERE {$field} LIKE ?";
        return $this->pdo->query($sql, ['%'.$str.'%']);
    }
}