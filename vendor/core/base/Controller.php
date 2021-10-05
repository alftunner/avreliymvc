<?php

namespace vendor\core\base;
/**
 * базовый класс контроллера
 */
abstract class Controller
{
    /**
     * Текущий маршрут с параметрами (controller, action, params)
     * @var array
     */
    public $currentRoute = [];

    /**
     * текущий вид
     * @var
     */
    public $view;

    /**
     * текущий шаблон
     * @var
     */
    public $layout;

    public function __construct($currentRoute) {
        $this->currentRoute = $currentRoute;
        $this->view = $currentRoute['action'];
    }

    public function getView() {
        $vObj = new View($this->currentRoute, $this->layout, $this->view);
        $vObj->render();
    }
}