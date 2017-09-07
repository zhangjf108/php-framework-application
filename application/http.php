<?php
return [
	'class' => '\Kerisy\Server\Http\Swoole',
	'bootstrap' => require __DIR__ . '/bootstrap.php',
	'host' => '0.0.0.0',
	'port' => 8888,
	'numWorkers' => 4,
    'name' => 'Kerisy_http',
    'packageMaxLength' => 8 * 1024 * 1024,
    'asDaemon' => 0,
    'pidFile' => __DIR__ . '/runtime/server.pid',
    'taskWorkers' => 4,
];
