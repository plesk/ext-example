<?php

class Example_Application extends pm_Application
{
    public function run()
    {
        self::init();

        Zend_Controller_Front::getInstance()->setControllerDirectory(APPLICATION_PATH . '/controllers');
        Zend_Layout::startMvc(array('layoutPath' => APPLICATION_PATH . '/layouts'));

        Zend_Controller_Front::getInstance()->dispatch();
    }
}