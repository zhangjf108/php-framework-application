<?php
/**
 * 上海葡萄纬度科技有限公司.
 * @copyright Copyright (c) 2017 Shanghai Putao Technology Co., Ltd.
 * @license http://www.putao.com/
 * @author Zhang Jianfeng <zhangjianfeng@putao.com>
 * @Date: 2017/6/30 18:22
 */

namespace Lib\Controller;


use Kerisy\Core\Context;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Kerisy\Controller\Controller as HttpController;


class BaseController extends HttpController
{
    public function __construct(ServerRequestInterface $request, Context $context)
    {
        parent::__construct($request, $context);
    }

    /**
     * @override
     *
     * @param mixed $data
     * @return ResponseInterface
     */
    public function renderJson($data): ResponseInterface
    {
        $ret = [];
        $ret['http_status_code'] = 200;
        $ret['data'] = $data;
        $ret['msg'] = '';
        $ret['elapsed'] = $this->getRequestDuration();

        return parent::renderJson($ret);
    }

    /**
     * 输出给Websocket客户端
     *
     * @param string $path
     * @param $data
     * @return string
     */
    public function renderWebSocket(string $path, $data)
    {
        $ret = [];
        $ret['path'] = $path;
        $ret['data'] = $data;
        return json_encode($ret, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 获取请求耗时(毫秒)
     */
    private function getRequestDuration()
    {
        return round((microtime(true) - $this->request->getRequestTimeFloat()) * 1000, 2);
    }
}