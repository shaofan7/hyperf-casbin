<?php

declare(strict_types=1);
/**
 * This file is part of 绿鸟科技.
 *
 * @link     https://www.greenbirds.cn
 * @document https://greenbirds.cn
 * @contact  liushaofan@greenbirds.cn
 */
return [
    /*
     * Casbin model setting.
     */
    'model' => [
        // Available Settings: "file", "text"
        'config_type' => 'file',
        'config_file_path' => BASE_PATH . '/config/autoload/casbin-rbac-model.conf',
        'config_text' => '',
    ],
    /*
     * Casbin adapter .
     */
    'adapter' => [
        'class' => \Donjan\Casbin\Adapters\Mysql\DatabaseAdapter::class,
        'constructor' => [
            'tableName' => 'casbin_rule',
        ],
    ],
    /*
     * Casbin watcher
     */
    'watcher' => [
        'enabled' => false,
        'class' => \Donjan\Casbin\Watchers\RedisWatcher::class,
        'constructor' => [
            'channel' => 'casbin',
        ],
    ],
    'log' => [
        'enabled' => false,
    ],
];
