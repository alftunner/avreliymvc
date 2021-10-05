<?php

namespace app\controllers;

use vendor\core\base\Controller;

class Main extends App
{
    public $layout = 'main';
    public function indexAction() {
        $this->view = 'test';
    }
}