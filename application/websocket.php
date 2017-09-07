<?php
use \swoole_http_request as SwooleHttpRequest;
use \swoole_http_response as SwooleHttpResponse;
use \swoole_websocket_server as SwooleWebsocketServer;

return [
	'class' => '\Kerisy\Server\Websocket\Swoole',
	'bootstrap' => require __DIR__ . '/bootstrap.php',
	'host' => '0.0.0.0',
	'port' => 10000,
	'numWorkers' => 4,
    'name' => 'kerisy_websocket',
    'packageMaxLength' => 8 * 1024 * 1024,
    'heartbeatCheckInterval' => 60,
    'heartbeatIdleTime' => 120,
    'asDaemon' => 0,
    'pidFile' => __DIR__ . '/runtime/websocket.pid',
    'taskWorkers' => 1,
    'onOpenCallback' => function (SwooleWebsocketServer $server, $request) {
        var_dump($request->fd);
    },
    'onCloseCallback' => function (SwooleWebsocketServer $swooleWebsocketServer, $fd) {
        var_dump($fd);
    },

//    'onMessageCallbask' => function (SwooleWebsocketServer $swooleWebsocketServer, $frame) {

//    },
];
