<?php
return [
    'log' => [
        'class' => 'Kerisy\Log\Logger',
        'targets' => [
            'file' => [
                'class' => 'Kerisy\Log\Target\StreamTarget',
                'enabled' => true,
                'stream' => KERISY_ENV == 'development' ? 'php://stderr' : RUNTIME_PATH . '/logs/log.log',
                // 'stream' => 'php://stderr',
                'level' => 'info',
            ]
        ],
    ],

    'logException' => [
        'class' => 'Kerisy\Log\Logger',
        'targets' => [
            'file' => [
                'class' => 'Kerisy\Log\Target\RotatingFileTarget',
                'enabled' => true,
                'filename' => RUNTIME_PATH . '/logs/exception.log',
                'maxFile' => 7,
                'level' => 'info',
            ]
        ],
    ],

    'cache' => [
//        'class' => 'Kerisy\Cache\Adapter\MemcachedAdapter',
//        'servers' => [
//            'memcached://127.0.0.1:11211',
//        ],

        'class' => 'Kerisy\Cache\Adapter\RedisAdapter',
        'dsn' => 'redis://127.0.0.1:6379',

        'defaultLifetime' => 0,  //默认过期时间
        'namespace' => 'kerisy_c_',   //缓存前缀，eg：kerisy_key
        'logComponent' => 'logException',   //logger组件,如不配置，则使用框架默认的log
        'options' => [],
    ],

    'simpleCache' => [
//        'class' => 'Kerisy\Cache\Simple\MemcachedCache',
//        'servers' => [
//            'memcached://127.0.0.1:11211',
//        ],

        'class' => 'Kerisy\Cache\Simple\RedisCache',
        'dsn' => 'redis://127.0.0.1:6379',

        'defaultLifetime' => 0,  //默认过期时间
        'namespace' => 'kerisy_c_',   //缓存前缀，eg：kerisy_key
        'logComponent' => 'logException',   //logger组件,如不配置，则使用框架默认的log
        'options' => [],
    ],

    'session' => [
        'class' => 'Kerisy\Session\Session',
        'name' => 'KERISY_SSID',    //session name
        'handle' => 'simpleCache', //simplecache component
        /*
        'handle' => [
            'class' => 'Kerisy\Cache\Simple\MemcachedCache',
            'servers' => [
                'memcached://127.0.0.1:11211',
            ],

            //'class' => 'Kerisy\Cache\Simple\RedisCache',
            //'dsn' => 'redis://127.0.0.1:6379',

            'defaultLifetime' => 0,  //默认过期时间
            'namespace' => 'kerisy_session_',   //缓存前缀，eg：kerisy_key
            'logComponent' => 'logException',   //logger组件,如不配置，则使用框架默认的log
            'options' => [],
        ],
        */
        'expire' => 15 * 24 * 3600, //不能为0，0表示立即过期
    ],

    'redis' => [
        'class' => 'Kerisy\NoSQL\Redis',
        /*
         * redis://127.0.0.1:6379
         * redis://127.0.0.1:6379/0    database index 0
         * redis://rmf:abcdef@127.0.0.1  SASL use "rmf" and pass "abcdef"
         * redis://user:bpass@/var/run/redis.sock socket "/var/run/redis.sock" and SASL user "user" and pass "pass"
         */
        'dsn' => 'redis://127.0.0.1:6379',
        'prefix' => 'kerisy_redis_',
        'options' => [],
    ],

    'db' => [
        'class' => 'Kerisy\Db\Connection',
        'dsn' => 'mysql:host=127.0.0.1;dbname=fudan',
        'username' => 'shangnaxue',
        'password' => 'shangnaxue',
        'charset' => 'utf8',
        //'tablePrefix' => 'pt_',
        'attributes' => [
            \PDO::ATTR_TIMEOUT => 10,
        ],
    ],
];
