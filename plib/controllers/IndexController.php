<?php
// Copyright 1999-2016. Parallels IP Holdings GmbH.
class IndexController extends pm_Controller_Action
{
    public function init()
    {
        parent::init();

        // Init title for all actions
        $this->view->pageTitle = $this->lmsg('pageTitle', ['product' => 'Plesk']);

        // Init tabs for all actions
        $this->view->tabs = [
            [
                'title' => 'Form',
                'action' => 'form',
            ],
            [
                'title' => 'Tools',
                'action' => 'tools',
            ],
            [
                'title' => 'List',
                'action' => 'list',
            ],
            [
                'title' => 'Active List',
                'action' => 'activelist',
            ],
        ];
    }

    public function indexAction()
    {
        // Default action will be formAction
        $this->_forward('form');
    }

    public function formAction()
    {
        // Display simple text in view
        $this->view->test = 'This is index action for testing module.';

        // Init form here
        $form = new pm_Form_Simple();
        $form->addElement('text', 'exampleText', [
            'label' => 'Example Text',
            'value' => pm_Settings::get('exampleText'),
            'required' => true,
            'validators' => [
                ['NotEmpty', true],
            ],
        ]);
        $form->addElement('password', 'examplePassword', [
            'label' => 'Example Password',
            'value' => '',
            'description' => 'Password: ' . pm_Settings::get('examplePassword'),
            'validators' => [
                ['StringLength', true, [5, 255]],
            ],
        ]);
        $form->addElement('textarea', 'exampleTextarea', [
            'label' => 'Example TextArea',
            'value' => pm_Settings::get('exampleTextarea'),
            'class' => 'f-middle-size',
            'rows' => 4,
            'required' => true,
            'validators' => [
                ['StringLength', true, [0, 255]],
            ],
        ]);
        $form->addElement('simpleText', 'exampleSimpleText', [
            'label' => 'Example SimpleText',
            'escape' => false,
            'value' => '<a href="#">Link</a>',
        ]);
        $form->addElement('select', 'exampleSelect', [
            'label' => 'Example Select',
            'multiOptions' => ['opt-0' => 'Option 0', 'opt-1' => 'Option 1'],
            'value' => pm_Settings::get('exampleSelect'),
            'required' => true,
        ]);
        $form->addElement('radio', 'exampleRadio', [
            'label' => 'Example Radio',
            'multiOptions' => ['opt-0' => 'Option 0', 'opt-1' => 'Option 1'],
            'value' => pm_Settings::get('exampleRadio'),
            'required' => true,
        ]);
        $form->addElement('checkbox', 'exampleCheckbox', [
            'label' => 'Example Checkbox',
            'value' => pm_Settings::get('exampleCheckbox'),
        ]);
        $form->addElement('hidden', 'exampleHidden', [
            'value' => 'example',
        ]);

        $form->addControlButtons([
            'cancelLink' => pm_Context::getModulesListUrl(),
        ]);

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

            $this->_status->addMessage('info', 'Data was successfully saved.');
            $this->_helper->json(['redirect' => pm_Context::getBaseUrl()]);
        }

        $this->view->form = $form;
    }

    public function toolsAction()
    {
        // Tools for pm_View_Helper_RenderTools
        $this->view->tools = [
            [
                'icon' => pm_Context::getBaseUrl() . 'images/hosting-setup.png',
                'title' => 'Example',
                'description' => 'Example module with UI samples',
                'link' => pm_Context::getBaseUrl(),
            ],
            [
                'icon' => pm_Context::getBaseUrl() . 'images/databases.png',
                'title' => 'Modules',
                'description' => 'Modules installed in the Panel',
                'link' => pm_Context::getModulesListUrl(),
            ],
        ];

        // Tools for pm_View_Helper_RenderSmallTools
        $this->view->smallTools = [
            [
                'title' => 'Example',
                'description' => 'Example module with UI samples',
                'class' => 'sb-app-info',
                'link' => pm_Context::getBaseUrl(),
            ],
            [
                'title' => 'Modules',
                'description' => 'Modules installed in the Panel',
                'class' => 'sb-suspend',
                'link' => pm_Context::getModulesListUrl(),
            ],
        ];
    }

    public function listAction()
    {
        $list = $this->_getNumbersList();

        // List object for pm_View_Helper_RenderList
        $this->view->list = $list;
    }

    private function _getNumbersList()
    {
        if (!isset($_SESSION['module']['example']['removed'])) {
            $_SESSION['module']['example']['removed'] = [];
        }

        $data = [];
        $iconPath = pm_Context::getBaseUrl() . 'images/icon_16.gif';
        for ($index = 1; $index < 150; $index++) {
            if (in_array($index, $_SESSION['module']['example']['removed'])) {
                continue;
            }

            $data[$index] = [
                'column-1' => '<a href="#">link #' . $index . '</a>',
                'column-2' => '<img src="' . $iconPath . '" /> image #' . $index,
            ];
        }

        $options = [
            'defaultSortField' => 'column-1',
            'defaultSortDirection' => pm_View_List_Simple::SORT_DIR_DOWN,
        ];
        $list = new pm_View_List_Simple($this->view, $this->_request, $options);
        $list->setData($data);
        $list->setColumns([
            pm_View_List_Simple::COLUMN_SELECTION,
            'column-1' => [
                'title' => 'Link',
                'noEscape' => true,
                'searchable' => true,
            ],
            'column-2' => [
                'title' => 'Description',
                'noEscape' => true,
                'sortable' => false,
            ],
        ]);
        $list->setTools([
            [
                'title' => 'Hide',
                'description' => 'Make selected rows invisible.',
                'class' => 'sb-make-invisible',
                'execGroupOperation' => [
                    'submitHandler' => 'function(url, ids) {
                        $A(ids).each(function(id) {
                            $("' . $list->getId() . '")
                                .select("[name=\'listCheckbox[]\'][value=\'" + id.value + "\']")
                                .first()
                                .up("tr")
                                .hide();
                        });
                    }'
                ],
            ], [
                'title' => 'Remove',
                'description' => 'Remove selected rows.',
                'class' => 'sb-remove-selected',
                'execGroupOperation' => $this->_helper->url('remove'),
            ],
        ]);
        // Take into account listDataAction corresponds to the URL /list-data/
        $list->setDataUrl(['action' => 'list-data']);

        return $list;
    }

    public function listDataAction()
    {
        $list = $this->_getNumbersList();

        // Json data from pm_View_List_Simple
        $this->_helper->json($list->fetchData());
    }

    public function removeAction()
    {
        $messages = [];
        foreach ((array)$this->_getParam('ids') as $id) {
            $_SESSION['module']['example']['removed'][] = $id;
            $messages[] = ['status' => 'info', 'content' => "Row #$id was successfully removed."];
        }
        $this->_helper->json(['status' => 'success', 'statusMessages' => $messages]);
    }

    public function activelistAction()
    {
    }

    public function service1Action()
    {
        if (strpos($this->view->url(), 'start') !== false) {
            pm_Settings::set('service1Status', 'started');
        } else if (strpos($this->view->url(), 'stop') !== false) {
            pm_Settings::set('service1Status', 'stopped');
        }
        $this->_helper->viewRenderer('activelist');
    }
}
