<?php

namespace vendor\widgets\menu;

use vendor\libs\Cache;

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
    protected $container = 'ul';

    /**
     * класс для $container
     * @var string
     */
    protected $class = 'menu';
    /**
     * таблица из которой будем брать данные для построения меню
     * @var
     */
    protected $table = 'categories';
    /**
     * отвечает за кеширование меню
     * @var
     */
    protected $cache = 3600;
    /**
     * ключ для кеша
     * @var string
     */
    protected $cacheKey = 'avreliy_menu';

    public function __construct($options = []) {
        $this->template = __DIR__ . '/menu_templates/select.php';
        $this->getOptions($options);
        $this->run();
    }

    /**
     * Метод для установки значений свойств из параметров конструктора (передаётся массив)
     * @param $options - массив с названиями свойств и их значениями
     */
    protected function getOptions($options) {
        foreach ($options as $property => $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }

    /**
     * Метод для вывода меню
     */
    protected function menuOutput() {
        echo "<{$this->container} class='{$this->class}'>";
        echo $this->menuHtml;
        echo "</{$this->container}>";
    }

    /**
     * Метод для вызова всех других методов класса
     */
    protected function run() {
        $cache = new Cache();
        $this->menuHtml = $cache->get($this->cacheKey);
        if (!$this->menuHtml) {
            $this->data = \R::getAssoc("SELECT * FROM {$this->table}"); //метод RedBean, который возращает данные в виде массива, где ключами служат ID записей теблицы
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);
            $cache->set($this->cacheKey, $this->menuHtml, $this->cache);
        }
        $this->menuOutput();
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
        $str = '';
        foreach ($tree as $id => $category) {
            $str .= $this->categoryToTemplate($category, $tab, $id);
        }
        return $str;
    }

    /**
     * Метод передаёт меню в шаблон для вывода
     * @param $category - категория
     * @param $tab
     * @param $id - id категории
     */
    protected function categoryToTemplate($category, $tab, $id) {
        ob_start();
        require $this->template;
        return ob_get_clean();
    }
}