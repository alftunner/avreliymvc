<?php

namespace vendor\widgets\menu;

/**
 * Класс для потроения меню
 */
class Menu
{
    /**
     * для хранения одномерного массива с категориями
     * @var
     */
    protected $data;
    /**
     * для хранения дерева категорий
     * @var
     */
    protected $tree;
    /**
     * готовый код меню
     * @var
     */
    protected $menuHtml;
    /**
     * шаблон для вывода меню
     * @var
     */
    protected $template;
    /**
     * родительский тег-обёртка для меню
     * @var
     */
    protected $container;
    /**
     * таблица из которой будем брать данные для построения меню
     * @var
     */
    protected $table;
    /**
     * отвечает за кеширование меню
     * @var
     */
    protected $cache;

    public function __construct() {
        $this->run();
    }

    /**
     * Метод для вызова всех других методов класса
     */
    protected function run() {
        $this->data = \R::getAssoc("SELECT * FROM categories"); //метод RedBean, который возращает данные в виде массива, где ключами служат ID записей теблицы
        $this->tree = $this->getTree();
    }

    /**
     * Метод перестраивает массив категорий в виде дерева
     * @return array
     */
    protected function getTree() {
        $tree = [];
        $data = $this->data;
        foreach ($data as $id => &$node) {
            if (!$node['parent']) {
                $tree[$id] = &$node;
            } else {
                $data[$node['parent']]['childes'][$id] = &$node;
            }
        }
        return $tree;
    }

    /**
     * Метод возвращает html-код меню
     * @param $tree - древовидная струтура меню
     * @param string $tab
     */
    protected function getMenuHtml($tree, $tab = '') {

    }

    /**
     * Метод передаёт меню в шаблон для вывода
     * @param $category - категория
     * @param $tab
     * @param $id - id категории
     */
    protected function categoryToTemplate($category, $tab, $id) {

    }
}