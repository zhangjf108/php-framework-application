<?php
/**
 * 上海葡萄纬度科技有限公司.
 * @copyright Copyright (c) 2017 Shanghai Putao Technology Co., Ltd.
 * @license http://www.putao.com/
 * @author Zhang Jianfeng <zhangjianfeng@putao.com>
 * @date: 2017/7/27 23:48
 * @version 3.0.0
 */

namespace App\Core\WebSocket;


use Carbon\Carbon;
use Kerisy\Controller\WebSocketController;


class TestController extends WebSocketController
{
    public function index()
    {
        $ret = [
            'time' => microtime(true),
            'date' => new Carbon()
        ];
        return $this->renderJson($ret);
    }
}