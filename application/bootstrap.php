<?php
defined('ROOT_PATH') || define('ROOT_PATH', dirname(__DIR__) . '/');
defined('APPLICATION_PATH') || define('APPLICATION_PATH', __DIR__ . '/');
defined('CONFIG_PATH') || define('CONFIG_PATH', APPLICATION_PATH . 'config/');
defined('RUNTIME_PATH') || define('RUNTIME_PATH', ROOT_PATH . 'runtime/');
defined('KERISY_ENV') || define('KERISY_ENV', getenv('KERISY_ENV') ?: 'development');
defined('KERISY_LANG') || define('KERISY_LANG', getenv('KERISY_LANG') ?: 'zh_cn');
var_dump(RUNTIME_PATH);
$config = [
    'applicationPath' => APPLICATION_PATH,
    'environment' => KERISY_ENV,
    'language' => KERISY_LANG,
    'configPath' => CONFIG_PATH,
    'runtime' => RUNTIME_PATH,
    'timezone' => 'Asia/Shanghai',
];

$type = isset($_SERVER['argv'][1]) ? strtolower($_SERVER['argv'][1]) : 'http';

$app = \Kerisy\Core\ApplicationFactory::createApplicaton($type, $config);

return $app;