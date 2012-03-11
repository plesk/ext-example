<?php

class IndexController extends pm_Controller_Action
{
    public function indexAction()
    {
        $this->view->pageTitle = 'Example Module';
        $this->view->test = 'This is index action for testing module.';

        $form = new pm_Form_Simple();
        $form->addElement('textarea', 'test', array(
            'label' => 'test',
            'value' => '',
            'class' => 'f-middle-size',
            'rows' => 4,
            'required' => true,
            'validators' => array(
                array('StringLength', true, array(0, 255)),
            ),
        ));
        $form->addControlButtons(array(
            'cancelLink' => '/',
        ));

        if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
            // Form proccessing here

            $this->_status->addMessage('info', 'ok');
            $this->_helper->json(array('redirect' => '/'));
        }

        $this->view->form = $form;
    }
}
