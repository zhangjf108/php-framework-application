<?php
/**
 * 上海葡萄纬度科技有限公司.
 * @copyright Copyright (c) 2017 Shanghai Putao Technology Co., Ltd.
 * @license http://www.putao.com/
 * @author Zhang Jianfeng <zhangjianfeng@putao.com>
 * @date: 2017/8/16 18:31
 * @version 3.0.0
 */

namespace App\Core\Rpc;


use Kerisy;
use Kerisy\Controller\RpcController;

class TestController extends RpcController
{
    public function test($a, $b)
    {
        $redis = Kerisy::$app->getRedis();
        $redis->incr('test_rpc');

        return $this->renderData([$a => $b, 'time' => date('Y-m-d H:i:s')]);
    }
}