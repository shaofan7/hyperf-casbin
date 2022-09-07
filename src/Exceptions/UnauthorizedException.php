<?php

declare(strict_types=1);
/**
 * This file is part of 绿鸟科技.
 *
 * @link     https://www.greenbirds.cn
 * @document https://greenbirds.cn
 * @contact  liushaofan@greenbirds.cn
 */
namespace Donjan\Casbin\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UnauthorizedException extends HttpException
{
    /**
     * Create a new exception instance.
     */
    public function __construct()
    {
        parent::__construct(403, 'This action is unauthorized.');
    }
}
