<?php

declare(strict_types=1);
/**
 * This file is part of 绿鸟科技.
 *
 * @link     https://www.greenbirds.cn
 * @document https://greenbirds.cn
 * @contact  liushaofan@greenbirds.cn
 */
namespace Donjan\Casbin\Adapters\Mysql;

use Hyperf\DbConnection\Model\Model;

/**
 * Rule Model.
 */
class Rule extends Model
{
    /**
     * timestamps.
     */
    public bool $timestamps = false;

    /**
     * Fillable.
     */
    protected array $fillable = ['ptype', 'v0', 'v1', 'v2', 'v3', 'v4', 'v5'];

    /**
     * Create a new Eloquent model instance.
     */
    public function __construct(array $attributes = [], string $table = 'rule')
    {
        $this->setTable($table);
        parent::__construct($attributes);
    }
}
