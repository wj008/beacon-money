<?php

namespace beacon\widget;

use beacon\core\Field;

#[\Attribute]
class Money extends Field
{

    public string $varType = 'string';
    public string $mathType = 'round';

    protected array $_attrs = ['class' => 'form-inp number'];

    public function setting(array $args):void
    {
        parent::setting($args);
        if (isset($args['mathType']) && is_string($args['mathType'])) {
            $this->mathType = $args['mathType'];
        }
    }

    protected function code(array $attrs = []): string
    {
        $attrs['type'] = 'text';
        return static::makeTag('input', ['attrs' => $attrs]);
    }

    /**
     * 加入数据库时
     * @param array $data
     */
    public function joinData(array &$data = []):void
    {
        $value = $this->getValue();
        if ($this->mathType == 'ceil') {
            $data[$this->name] = ceil(bcmul($value, 100, 4));
        } else if ($this->mathType == 'floor') {
            $data[$this->name] = floor(bcmul($value, 100, 4));
        } else {
            $data[$this->name] = round(bcmul($value, 100, 4));
        }
    }

    /**
     * 从数据库来的
     * @param array $data
     * @return mixed
     */
    public function fromData(array $data = []): mixed
    {
        $value = $data[$this->name] ?? null;
        if ($value !== null) {
            $value = $value / 100;
        }
        return $value;
    }


}