<?php

namespace app\controllers;

use vendor\core\base\Controller;

class MainController extends AppController
{
    public function indexAction() {
        $name = 'alftunner';
        $this->setData(['name' => 'alftunner', 'test' => 'data']);
    }
}