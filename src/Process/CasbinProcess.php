<?php

declare(strict_types=1);
/**
 * This file is part of 绿鸟科技.
 *
 * @link     https://www.greenbirds.cn
 * @document https://greenbirds.cn
 * @contact  liushaofan@greenbirds.cn
 */
namespace Donjan\Casbin\Process;

use Donjan\Casbin\Event\PipeMessage;
use Hyperf\Process\AbstractProcess;
use Hyperf\Redis\Redis;
use Swoole\Server;

class CasbinProcess extends AbstractProcess
{
    public string $name = 'casbin-watcher';

    protected Server $server;

    public function handle(): void
    {
        $redis = $this->container->get(Redis::class);
        $redis->setOption(\Redis::OPT_READ_TIMEOUT, -1);
        $channel = config('casbin.watcher.constructor.channel') ?? 'casbin';
        $redis->subscribe([$channel], function ($instance, $channel, $message) {
            $server = $this->server;
            $workerCount = $server->setting['worker_num'] + ($server->setting['task_worker_num'] ?? 0) - 1;
            for ($workerId = 0; $workerId <= $workerCount; ++$workerId) {
                $server->sendMessage(new PipeMessage(PipeMessage::LOAD_POLICY), $workerId);
            }
        });
    }

    public function bind($server): void
    {
        $this->server = $server;
        parent::bind($server);
    }

    public function isEnable($server): bool
    {
        return config('casbin.watcher.enabled') == true;
    }
}
