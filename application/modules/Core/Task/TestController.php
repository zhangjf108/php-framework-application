<?php
/**
 * 上海葡萄纬度科技有限公司.
 * @copyright Copyright (c) 2017 Shanghai Putao Technology Co., Ltd.
 * @license http://www.putao.com/
 * @author Zhang Jianfeng <zhangjianfeng@putao.com>
 * @date: 2017/7/28 21:25
 * @version 3.0.0
 */

namespace App\Core\Task;


use Kerisy\Controller\TaskController;

class TestController extends TaskController
{
    public function index()
    {
        var_dump($this->data);
    }
}