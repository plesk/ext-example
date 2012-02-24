<?php

class IndexController extends pm_Controller_Admin
{
    public function indexAction()
    {
        $this->view->pageTitle = 'Example Module';
        $this->view->test = 'This is index action for testing module.';
    }
}
