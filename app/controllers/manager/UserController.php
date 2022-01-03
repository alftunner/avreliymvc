<?php

namespace app\controllers\manager;

use vendor\core\base\View;

class UserController extends AppController
{
    public function indexAction() {
        View::setMeta('Проверка', 'Это проверочные метаданные', 'данные, проверка, метаданные');
    }
    public function testAction() {
        echo __METHOD__;
    }
}