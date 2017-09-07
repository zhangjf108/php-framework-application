<?php
/**
 * 域名,uri配置
 */
return [
    [
        'prefix' => 'Api',
        'domain' => [
            'api-framework-local.ptdev.cn',
            'api-fpm-local.ptdev.cn',
            'api-framework-websocket.ptdev.cn'
        ],
        'routes' => [
            ['GET', '/', 'core/test/get'],
        ]
    ],
];
