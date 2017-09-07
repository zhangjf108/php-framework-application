<?php
/**
 * 上海葡萄纬度科技有限公司.
 * @copyright Copyright (c) 2017 Shanghai Putao Technology Co., Ltd.
 * @license http://www.putao.com/
 * @author Zhang Jianfeng <zhangjianfeng@putao.com>
 * @date: 2017/7/24 10:55
 * @version 3.0.0
 */

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

defined('ROOT_PATH') || define('ROOT_PATH', dirname(__DIR__) . '/');
defined('APPLICATION_PATH') || define('APPLICATION_PATH', dirname(__DIR__) . '/');
defined('CONFIG_PATH') || define('CONFIG_PATH', APPLICATION_PATH . '/config/');
defined('RUNTIME_PATH') || define('RUNTIME_PATH', APPLICATION_PATH . '/runtime/');
defined('KERISY_ENV') || define('KERISY_ENV', getenv('KERISY_ENV') ?: 'development');
defined('KERISY_LANG') || define('KERISY_LANG', getenv('KERISY_LANG') ?: 'zh_cn');

$config = [
    'applicationPath' => APPLICATION_PATH,
    'environment' => KERISY_ENV,
    'language' => KERISY_LANG,
    'configPath' => CONFIG_PATH,
    'runtime' => RUNTIME_PATH,
    'timezone' => 'Asia/Shanghai',
];

$request = \Kerisy\Http\Factory\ServerRequestFactory::createServerRequestFromGlobals();

$app = new \Kerisy\Core\Application\Web($config);

$response = $app->bootstrap()->handleRequest($request);;

if (headers_sent($file, $line)) {
    throw new \LogicException(sprintf('Headers already sent in %s:%d', $file, $line));
}

header(sprintf('Status: %d %s', $response->getStatusCode(), $response->getReasonPhrase()), true, $response->getStatusCode());

foreach ($response->getHeaders() as $name => $content) {
    header(sprintf('%s: %s', $name, $response->getHeaderLine($name)));
}

@ob_start();
print $response->getBody();
@ob_end_flush();

exit(0);
