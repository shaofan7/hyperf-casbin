<?php

declare(strict_types=1);
/**
 * This file is part of 绿鸟科技.
 *
 * @link     https://www.greenbirds.cn
 * @document https://greenbirds.cn
 * @contact  liushaofan@greenbirds.cn
 */
namespace Donjan\Casbin\Event;

class PipeMessage
{
    public const LOAD_POLICY = 'loadPolicy';

    protected mixed $data = [];

    protected $action;

    public function __construct($action, $data = [])
    {
        $this->action = $action;
        $this->data = $data;
    }

    public function __get($name)
    {
        return $this->{$name};
    }

    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }
}
