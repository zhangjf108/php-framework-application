<?php
/**
 * 上海葡萄纬度科技有限公司.
 * @copyright Copyright (c) 2017 Shanghai Putao Technology Co., Ltd.
 * @license http://www.putao.com/
 * @author Zhang Jianfeng <zhangjianfeng@putao.com>
 * @date: 2017/6/29 21:58
 * @version 2.0.3
 */

namespace Lib\Exception;


use Kerisy\Exception\CustomException;
use Kerisy\Exception\Exception;

class UserCustomException extends CustomException
{
    /**
     * User custom exception constructor.
     *
     * @param int         $code
     * @param string $message
     * @param int         $statusCode
     * @param Exception   $previous The previous exception used for the exception chaining.
     */
    public function __construct($code = 0, $message = null, int $statusCode = 200, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->setStatusCode($statusCode);

    }

    /**
     * Get the exception response headers.
     *
     * @return array
     */
    final public function getResponseHeaders(): array
    {
        return ['Content-Type' => 'application/json;charset=utf-8'];
    }

    /**
     * Get the exception response data.
     *
     * @return string
     */
    final public function getResponseData(): string
    {
        $data = ['http_status_code' => $this->getCode(), 'data' => [], 'msg' => $this->getMessage(), 'elapsed' => 0];
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}