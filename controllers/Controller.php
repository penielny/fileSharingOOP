<?php

class Controller
{

    public $method = null;

    public function __construct()
    {
        session_start();
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function get(mixed $func)
    {
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            if (is_callable($func)) {

               call_user_func($func,$_GET);
            }
        }
    }

    public function post(mixed $func)
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (is_callable($func)) {

               call_user_func($func,$_POST);
            }
        }
    }
}
