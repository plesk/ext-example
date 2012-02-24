<?php

class Application extends pm_Application
{
    public function run()
    {
        self::init();

        Zend_Controller_Front::getInstance()->dispatch();
    }
}