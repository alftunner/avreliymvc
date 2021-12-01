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

    /**
     * текущий шаблон
     * @var array
     */
    public $data = [];

    public function __construct($currentRoute) {
        $this->currentRoute = $currentRoute;
        $this->view = $currentRoute['action'];
    }

    /**
     *Метод для подключения вида и шаблона (вызывается в dispatch() Router)
     */
    public function getView() {
        $vObj = new View($this->currentRoute, $this->layout, $this->view);
        $vObj->render($this->data);
    }

    /**
     *Метод для передачи пользовательских данных в View (передача данных в render() произойдёт при вызове getView() в dispatch() Router)
     */
    public function setData($data) {
        $this->data = $data;
    }

    /**
     *Метод проверки запроса на асинхронность
     */
    public function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }
}