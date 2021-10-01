<?php

namespace app\controllers;

use vendor\core\base\Controller;

class Page extends Controller
{
    public function viewAction() {
        ShowMeArr($this->currentRoute);
        echo 'View::Page';
    }
}