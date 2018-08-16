<?php

class ApiController extends pm_Controller_Action
{
    public function dateAction()
    {
        $this->_helper->json(date('Y-m-d H:i:s'));
    }

    public function listAction()
    {
        $data = [];
        $iconPath = pm_Context::getBaseUrl() . 'images/icon_16.gif';
        for ($index = 1; $index <= 150; $index++) {
            $data[] = [
                'key' => "$index",
                'column1' => $index,
                'column2' => $iconPath,
            ];
        }

        $this->_helper->json($data);
    }

    public function saveAction()
    {
        $this->_helper->serverForm(
            [
                'exampleText' => [
                    'required' => true,
                    'filters' => [
                        ['StringTrim'],
                    ],
                    'validators' => [
                        ['StringLength', true, 3],
                    ],
                ],
            ],
            function ($args) {
                pm_Settings::set('exampleText', $args['exampleText']);
                return $args;
            }
        );
    }
}
