<?php

namespace app\controllers;

use vendor\core\base\Controller;

class Main extends App
{
    public function indexAction() {
        $name = 'alftunner';
        $this->setData(['name' => 'alftunner', 'test' => 'data']);
    }
}