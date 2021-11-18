<?php

namespace app\controllers;

use app\models\Main;
use vendor\core\base\Controller;

class PageController extends AppController
{
    public function viewAction() {
        $menu = $this->menu;
        $title = 'PAGE TITLE';
        $this->setData(compact('title', 'menu'));
    }

    public function testAction() {
        $this->layout = 'main';
        $title = 'TEST TITLE';
        $this->setData(compact('title'));
    }
}