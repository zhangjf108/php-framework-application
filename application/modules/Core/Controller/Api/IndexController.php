<?php
/**
 * 上海葡萄纬度科技有限公司.
 * @copyright Copyright (c) 2017 Shanghai Putao Technology Co., Ltd.
 * @license http://www.putao.com/
 * @author Zhang Jianfeng <zhangjianfeng@putao.com>
 * @Date: 2017/6/29 23:40
 */

namespace App\Core\Controller\Api;


use App\Core\Model\College;
use Kerisy;
use Kerisy\Core\Context;
use Kerisy\Http\Cookie;
use Lib\Controller\BaseController;
use Lib\UserCustomException;
use Psr\Http\Message\ServerRequestInterface;
use Kerisy\Validator\Validator;

class IndexController extends BaseController
{
    public function index()
    {
        //$this->redirect('https://baidu.com');

        $ret = [
            //$this->request->getBody()->getContents(),
            $this->request->getQueryParams(),
            $this->request->getParsedBody(),
            $this->request->getUri()->getHost(),
            $this->request->getUri()->getPath(),
            $this->request->getUri()->getScheme(),
            $this->request->getRequestTimeFloat(),
        ];

        //var_dump($this->request->getCookieParams());
        /*
        $files = $this->request->getUploadedFile('file');

        print_r($files);

        foreach ($files as $file) {
            $file->moveTo('/tmp/swoole_new_' . $file->getClientFilename());
        }
        */

        //throw new \RedisException('Redis server went away');

        //$this->addCookie(new Cookie('test_cookie' . mt_rand(1, 99999), 'cookie_value'));

        //throw new UserCustomException(201, 'Test User Custom Exception');

        //var_dump(Kerisy::$app->getConfig('routes')->all());

        //Kerisy::$app->get('logException')->info(['test']);

        //$a = 2 / 0;

        //$b = $c - 1;


//        $client = Kerisy\Cache\Adapter\MemcachedAdapter::createConnection('memcached://127.0.0.1:11211');
//        $cache = new Kerisy\Cache\Adapter\MemcachedAdapter($client, 'name');
//        $cache->setLogger(Kerisy::$app->get('logException'));
//
//        $client = Kerisy\Cache\Adapter\RedisAdapter::createConnection('redis://127.0.0.1:6379');
//        $cache = new Kerisy\Cache\Adapter\RedisAdapter($client, 'name');
//        $cache->setLogger(Kerisy::$app->get('logException'));
//
//        $item = $cache->getItem('key1');
//
//        var_dump($item->isHit());
//
//        if ($item->isHit()) {
//            var_dump($item->get());
//        }
//
//        $item->set(['test' => 'array', 'obj' => new \stdClass()]);
//        $saved = $cache->save($item);
//
//        var_dump($saved);
//
//        $client = Kerisy\Cache\Simple\RedisCache::createConnection('redis://127.0.0.1:6379');
//        $cache = new Kerisy\Cache\Simple\RedisCache($client, 'name');
//        var_dump($cache->get('key1'));

//        $item = Kerisy::$app->cache->getItem('key1');
//        $item->set(date('Y-m-d H:i:s'));
//        Kerisy::$app->cache->save($item);

        //var_dump($this->getSession());

        return $this->renderJson($ret);
    }

    public function test()
    {
        $item = Kerisy::$app->cache->getItem('key1');
        return $this->renderJson($item->get());
    }

    public function simple()
    {
        $item = Kerisy::$app->simpleCache->get('key1');
        return $this->renderJson($item);
    }

    public function redis()
    {
        Kerisy::$app->redis->set('key4', ['version' => phpversion(), 'test' => 'dddddd']);
        $value4 = Kerisy::$app->redis->get('key4');

        //var_dump($value4);

        $redis = Kerisy::$app->redis;

        //return $this->renderJson($redis->mget(['key2', 'key4']));

        /*
        $redis->lpush('key1', ['test1', 'test2']);
        $redis->lpush('key1', ['test3', 'test4']);
        $redis->lpush('key1', 'test5');

        $ret = $redis->lrange('key1',0, -1);
        */

        $redis->hset('key3', 'name', '中文中文');
        $redis->hset('key3', 'age', 12);
        $ret = $redis->hgetall('key3');

        return $this->renderJson($ret);
    }

    public function session()
    {
        $r = $this->setSession('name', 123);
        //var_dump($r);
        $this->setSession('age', 456);
        return $this->renderJson(spl_object_hash($this));
    }

    public function get()
    {
        return $this->renderJson($this->getSession());
    }

    public function tpl()
    {
        return $this->render('core/index/profile', ['name' => '中文', 'title' => '标题']);
    }

    public function db()
    {
        $ret = Kerisy::$app->simpleCache->get('db_cache1');
        if (!$ret) {

            $start = microtime(true);
            College::findOne(['college_id' => 1]);
            //var_dump((microtime(true) - $start) * 1000);

            $start = microtime(true);

            $colleges = College::find()->limit(1)->all();
            foreach ($colleges as $college) {
                $ret[] = $college->toArray(['college_id', 'name']);
            }

            //var_dump((microtime(true) - $start) * 1000);

            Kerisy::$app->simpleCache->set('db_cache', $ret, 10);
        }

        return $this->renderJson($ret);
    }

    public function val()
    {
        $ret = Validator::between(1, 18, true)->validate(18);

        $r = Validator::stringType()->length(1, 5)->validate('string');
        //var_dump($r);

        /*
        $validator = new \Cake\Validation\Validator();
        $validator->requirePresence(['test', 'test2'])->notEmpty(['test', 'test2'], 'test');
        $validator->email('email', true, 'email, error');
        $errors = $validator->errors(['test' => '1234', 'email' => 'zelome163.com']);
        foreach ($errors as $error) {
            print_r($error);
        }
        */

        return $this->renderJson($ret);
    }

    public function task()
    {
        $ret = Kerisy::$app->task('/core/test/index', [123, 456]);
        return $this->renderJson($ret);
    }

    /**
     * http=>websocket
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function websocket()
    {
        $college = College::findOne(['college_id' => 1])->toArray();

        foreach (Kerisy::$app->server->connections as $fd) {
            $clientInfo = Kerisy::$app->server->connection_info($fd);
            if ($clientInfo['websocket_status'] != WEBSOCKET_STATUS_FRAME) {
                continue;
            }
            Kerisy::$app->server->push($fd, $this->renderWebSocket('user/user/websocket', $college));
        }

        return $this->renderJson($college);
    }
}