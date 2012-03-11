<?php

class Example_Application extends pm_Application
{
    public function run()
    {
        // Init scripts and helpers for rendering Plesk screens
        self::init();

        // Init path for application controllers
        Zend_Controller_Front::getInstance()->setControllerDirectory(APPLICATION_PATH . '/controllers');

        // Init path for application layouts
        Zend_Layout::startMvc(array('layoutPath' => APPLICATION_PATH . '/layouts'));

        Zend_Controller_Front::getInstance()->dispatch();
    }
}