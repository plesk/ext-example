<?php

class IndexController extends pm_Controller_Action
{
    public function indexAction()
    {
        $this->view->pageTitle = 'Example Module';
        $this->view->test = 'This is index action for testing module.';

        $test = pm_Settings::get('testing');

        $form = new pm_Form_Simple();
        $form->addElement('textarea', 'test', array(
            'label' => 'Lets remember this text',
            'value' => $test,
            'class' => 'f-middle-size',
            'rows' => 4,
            'required' => true,
            'validators' => array(
                array('StringLength', true, array(0, 255)),
            ),
        ));
        $form->addControlButtons(array(
            'cancelLink' => pm_Context::getModulesListUrl(),
        ));

        if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
            // Form proccessing here
            pm_Settings::set('testing', $form->getValue('test'));

            $this->_status->addMessage('info', 'ok');
            $this->_helper->json(array('redirect' => pm_Context::getBaseUrl()));
        }

        $this->view->form = $form;
    }
}
