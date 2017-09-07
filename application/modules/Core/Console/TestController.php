<?php
/**
 * 上海葡萄纬度科技有限公司.
 * @copyright Copyright (c) 2017 Shanghai Putao Technology Co., Ltd.
 * @license http://www.putao.com/
 * @author Zhang Jianfeng <zhangjianfeng@putao.com>
 * @date: 2017/7/21 21:50
 * @version 3.0.0
 */

namespace App\Core\Console;

use Kerisy;
use App\Core\Model\CollegeV2;
use Kerisy\Controller\ConsoleController;

class TestController extends ConsoleController
{
    public function test()
    {
        var_dump($this->argv);

        $college = new CollegeV2();
        $college->name = '浙大';
        $college->save();

        var_dump($college->toArray());

        $college = CollegeV2::findOne(2);
        $college->name = '清华';
        $college->save();

        //Kerisy::$app->redis->set('key4', $college->toArray());

        $ret = Kerisy::$app->redis->get('key4');
        //var_dump($ret);

        return 0;
    }

    public function rpc()
    {
        $rpc = new Kerisy\Client\RPC\SwooleRpcClient();
        $rpc->addServers([['host' => '127.0.0.1', 'port' => 10000, 'status' => 'online', 'weight' => 100]]);

        $result = $rpc->ping();
        var_dump($result);

        $start = microtime(true);

        for ($i = 0; $i < 10000; $i++) {
            $result = $rpc->task('core/test/test', ['a' => 1, 'b' => 2]);
            $ret = $result->getResult();
        }

        $end = microtime(true);

        echo ($end - $start) . PHP_EOL;

        /*
        $ret1 = $rpc->task('core/test/test', ['a' => 1, 'b' => 2]);
        $ret2 = $rpc->task('core/test/test', ['a' => 2, 'b' => 3]);
        $ret3 = $rpc->task('core/test/test', ['a' => 3, 'b' => 4]);
        $ret4 = $rpc->task('core/test/test', ['a' => 4, 'b' => 5]);

        $count = $rpc->wait(0.5);

        if ($count == 4) {
            var_dump($ret1->data, $ret2->data, $ret3->data, $ret4->data);
        }
        */
    }

}