<?php

namespace vendor\core\base;
/**
 * базовый класс вида
 */
class View
{
    /**
     * Текущий маршрут с параметрами (controller, action, params)
     * @var array
     */
    public $currentRoute = [];

    /**
     * текущий Вид
     * @var
     */
    public $view;

    /**
     * текущий шаблон
     * @var
     */
    public $layout;

    public function __construct($currentRoute, $layout = '', $view = '') {
        $this->currentRoute = $currentRoute;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;
    }

    /**
     * Метод для подключения шаблона и вида (вызывается в базовом контролле)
     * @param $data - данные которые тянутся из контролле для отображения на странице
     */
    public function render($data) {
        if (is_array($data)) {
            extract($data); //функция создаёт переменные на основании ключей массива
        }
        $file_view = APP . "/views/{$this->currentRoute['controller']}/{$this->view}.php";
        ob_start();
        if (is_file($file_view)) {
            require $file_view;
        } else {
            echo "<p>Не найден вид <b>{$file_view}</b></p>";
        }
        $content = ob_get_clean();

        if (false !== $this->layout) {
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($file_layout)) {
                require $file_layout;
            } else {
                echo "<p>Не найден шаблон <b>{$file_layout}</b></p>";
            }
        }
    }
}