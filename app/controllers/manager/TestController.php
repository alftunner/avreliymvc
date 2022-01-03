<?php

namespace app\controllers\manager;

class TestController extends AppController
{
    public function indexAction() {
        echo __METHOD__;
    }
    public function testAction() {
        echo __METHOD__;
    }
}