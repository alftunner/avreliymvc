<?php

namespace vendor\core\base;
/**
 * базовый класс контроллера
 */
abstract class Controller
{
    public $currentRoute = [];

    public function __construct($currentRoute) {
        $this->currentRoute = $currentRoute;
    }
}