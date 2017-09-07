<?php
return [
	'class' => '\Kerisy\Server\Swoole',
	'bootstrap' => require __DIR__ . '/bootstrap.php',
	'host' => '0.0.0.0',
	'port' => 8888,
	'numWorkers' => 4,
    'name' => 'kerisy_tcp',
    'packageMaxLength' => 8 * 1024 * 1024,
    'asDaemon' => 0,
    'pidFile' => __DIR__ . '/runtime/server.pid',
    'taskWorkers' => 1,
];
