<?php

declare(strict_types=1);
/**
 * This file is part of 绿鸟科技.
 *
 * @link     https://www.greenbirds.cn
 * @document https://greenbirds.cn
 * @contact  liushaofan@greenbirds.cn
 */
namespace Donjan\Casbin\Watchers;

use Casbin\Persist\Watcher;
use Closure;
use Hyperf\Redis\Redis;
use Psr\Container\ContainerInterface;

/**
 * RedisWatcher.
 */
class RedisWatcher implements Watcher
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Redis
     */
    private $pubRedis;

    /**
     * channel.
     */
    private $channel;

    /**
     * the DatabaseAdapter constructor.
     *
     * @param string $channel
     */
    public function __construct(ContainerInterface $container, $channel)
    {
        $this->channel = $channel;
        $this->container = $container;
        $this->pubRedis = $container->get(Redis::class);
    }

    /**
     * Sets the callback function that the watcher will call when the policy in DB has been changed by other instances.
     * A classic callback is loadPolicy() method of Enforcer class.
     */
    public function setUpdateCallback(Closure $func): void
    {
    }

    /**
     * Update calls the update callback of other instances to synchronize their policy.
     * It is usually called after changing the policy in DB, like savePolicy() method of Enforcer class,
     * addPolicy(), removePolicy(), etc.
     */
    public function update(): void
    {
        $this->pubRedis->publish($this->channel, 'casbin rules updated');
    }

    /**
     * Close stops and releases the watcher, the callback function will not be called any more.
     */
    public function close(): void
    {
        $this->pubRedis->close();
    }
}
