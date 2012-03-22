<?php

class IndexController extends pm_Controller_Action
{
    public function init()
    {
        parent::init();

        $this->view->tabs = array(
            array(
                'title' => 'Index',
                'action' => 'index',
            ),
            array(
                'title' => 'Test',
                'action' => 'test',
            ),
        );
    }

    public function indexAction()
    {
        $this->view->pageTitle = 'Example Module';
        $this->view->test = 'This is index action for testing module.';

        $form = new pm_Form_Simple();
        $form->addElement('text', 'exampleText', array(
            'label' => 'Example Text',
            'value' => pm_Settings::get('exampleText'),
            'required' => true,
            'validators' => array(
                array('NotEmpty', true),
            ),
        ));
        $form->addElement('password', 'examplePassword', array(
            'label' => 'Example Password',
            'value' => '',
            'description' => 'Password: ' . pm_Settings::get('examplePassword'),
            'validators' => array(
                array('StringLength', true, array(5, 255)),
            ),
        ));
        $form->addElement('textarea', 'exampleTextarea', array(
            'label' => 'Example TextArea',
            'value' => pm_Settings::get('exampleTextarea'),
            'class' => 'f-middle-size',
            'rows' => 4,
            'required' => true,
            'validators' => array(
                array('StringLength', true, array(0, 255)),
            ),
        ));
        $form->addElement('simpleText', 'exampleSimpleText', array(
            'label' => 'Example SimpleText',
            'escape' => false,
            'value' => '<a href="#">Link</a>',
        ));
        $form->addElement('select', 'exampleSelect', array(
            'label' => 'Example Select',
            'multiOptions' => array('opt-0' => 'Option 0', 'opt-1' => 'Option 1'),
            'value' => pm_Settings::get('exampleSelect'),
            'required' => true,
        ));
        $form->addElement('radio', 'exampleRadio', array(
            'label' => 'Example Radio',
            'multiOptions' => array('opt-0' => 'Option 0', 'opt-1' => 'Option 1'),
            'value' => pm_Settings::get('exampleRadio'),
            'required' => true,
        ));
        $form->addElement('checkbox', 'exampleCheckbox', array(
            'label' => 'Example Checkbox',
            'value' => pm_Settings::get('exampleCheckbox'),
        ));
        $form->addElement('hidden', 'exampleHidden', array(
            'value' => 'example',
        ));

        $form->addControlButtons(array(
            'cancelLink' => pm_Context::getModulesListUrl(),
        ));

        if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
            // Form proccessing here
            pm_Settings::set('exampleText', $form->getValue('exampleText'));
            if ($form->getValue('examplePassword')) {
                pm_Settings::set('examplePassword', $form->getValue('examplePassword'));
            }
            pm_Settings::set('exampleTextarea', $form->getValue('exampleTextarea'));
            pm_Settings::set('exampleSelect', $form->getValue('exampleSelect'));
            pm_Settings::set('exampleRadio', $form->getValue('exampleRadio'));
            pm_Settings::set('exampleCheckbox', $form->getValue('exampleCheckbox'));

            $this->_status->addMessage('info', 'ok');
            $this->_helper->json(array('redirect' => pm_Context::getBaseUrl()));
        }

        $this->view->form = $form;
    }

    public function testAction()
    {
        $this->view->pageTitle = 'Test';

        $this->view->tools = array(
            array(
                'icon' => $this->view->skinUrl('/') . "img/icons/big/manage-mobile-sites_32.gif",
                'title' => 'Unity mobile',
                'description' => 'Tools test',
                'link' => pm_Context::getModulesListUrl(),
            ),
        );
    }
}
