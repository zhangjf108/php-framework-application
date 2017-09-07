<?php
use \swoole_http_request as SwooleHttpRequest;
use \swoole_http_response as SwooleHttpResponse;
use \swoole_websocket_server as SwooleWebsocketServer;

return [
	'class' => '\Kerisy\Server\RPC\Swoole',
	'bootstrap' => require __DIR__ . '/bootstrap.php',
	'host' => '0.0.0.0',
	'port' => 10000,
	'numWorkers' => 4,
    'name' => 'kerisy_rpc',
    'packageMaxLength' => 8 * 1024 * 1024,
    'heartbeatCheckInterval' => 60,
    'heartbeatIdleTime' => 120,
    'asDaemon' => 0,
    'pidFile' => __DIR__ . '/runtime/rpc.pid',
    'taskWorkers' => 1,
];
