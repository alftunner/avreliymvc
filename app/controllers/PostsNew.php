<?php

class PostsNew
{
    public function __construct() {
        echo 'PostsNew::__construct';
    }
    public function testAction() {
        echo 'PostsNew::test';
    }
    public function testPageAction() {
        echo 'PostsNew::testPage';
    }
    public function before() {
        echo 'PostsNew::before';
    }
}