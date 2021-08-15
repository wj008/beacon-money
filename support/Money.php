<?php

namespace tool\support;

use beacon\core\Form;
use beacon\widget\RadioGroup;
use tool\libs\Support;

#[Support(name: '金额 Money', types: ['int(11)'])]
#[Form(title: '金额', template: 'form/field_support.tpl')]
class Money
{

    #[RadioGroup(
        label: '小数处理方式',
        star: true,
        options: [
            [
                'value' => 'round',
                'text' => 'round四舍五入',
                'tips' => ''
            ],
            [
                'value' => 'floor',
                'text' => 'floor向下取整',
                'tips' => ''
            ],
            [
                'value' => 'ceil',
                'text' => 'ceil向上取整',
                'tips' => ''
            ]
        ]
    )]
    public string $mathType = 'round';

    public function export(): array
    {
        return [
            'varType' => 'string',
            'mathType'=>$this->mathType
        ];
    }
}