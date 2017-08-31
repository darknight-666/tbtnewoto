<?php

header('Content-type:text/html;charset=utf-8');
include_once $_SERVER ['DOCUMENT_ROOT'] . '/protected/extensions/UnionPay/sdk/acp_service.php';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/protected/extensions/UnionPay/sdk/SDKConfig.php';

/**
 * 银联支付
 * 2017-08-31
 */
class UnionPayApi {

    /**
     * 无跳转支付接口
     */
    static function payment($params) {
        com\unionpay\acp\sdk\AcpService::sign($params);
        $uri = com\unionpay\acp\sdk\SDKConfig::getSDKConfig()->frontTransUrl;
        LogServer::payLog($uri, $params, '');
        $html_form = com\unionpay\acp\sdk\AcpService::createAutoFormHtml($params, $uri);
        LogServer::payLog($uri, $params, $html_form);
        echo $html_form;
        exit;
    }

    /**
     * 退货接口
     */
    static function refund($params) {
        com\unionpay\acp\sdk\AcpService::sign($params); // 签名
        $url = com\unionpay\acp\sdk\SDKConfig::getSDKConfig()->backTransUrl;
        $result_arr = com\unionpay\acp\sdk\AcpService::post($params, $url);
        if (count($result_arr) <= 0) { //没收到200应答的情况
            LogServer::payLog($url, $params, array('没收到200应答的情况'));
            return;
        }
        LogServer::payLog($url, $params, $result_arr);
        if (!com\unionpay\acp\sdk\AcpService::validate($result_arr)) {
            LogServer::payLog($url, $params, array('应答报文验签失败'));
            return;
        }
        LogServer::payLog($url, $params, array('应答报文验签成功'));
        if ($result_arr["respCode"] == "00") {
            //交易已受理，等待接收后台通知更新订单状态，如果通知长时间未收到也可发起交易状态查询
            //TODO
            echo "受理成功。<br>\n";
        } else if ($result_arr["respCode"] == "03" || $result_arr["respCode"] == "04" || $result_arr["respCode"] == "05") {
            //后续需发起交易状态查询交易确定交易状态
            //TODO
            echo "处理超时，请稍微查询。<br>\n";
        } else {
            //其他应答码做以失败处理
            //TODO
            echo "失败：" . $result_arr["respMsg"] . "。<br>\n";
        }
    }

    /**
     * 开通状态查询
     */
    static function openQuery($params) {
        com\unionpay\acp\sdk\AcpService::sign($params); // 签名
        $url = com\unionpay\acp\sdk\SDKConfig::getSDKConfig()->backTransUrl;
        $result_arr = com\unionpay\acp\sdk\AcpService::post($params, $url);
        if (count($result_arr) <= 0) { //没收到200应答的情况
            LogServer::payLog($url, $params, '');
            return;
        }
        LogServer::payLog($url, $params, $result_arr); //页面打印请求应答数据
        if (!com\unionpay\acp\sdk\AcpService::validate($result_arr)) {
            LogServer::payLog($url, $params, array('应答报文验签失败'));
            return;
        }
        LogServer::payLog($url, $params, array('应答报文验签成功')); //页面打印请求应答数据
        if ($result_arr["respCode"] == "00") {
            //开通成功
            echo "开通成功。<br>\n";

            //customerInfo子域的获取
            if (array_key_exists("customerInfo", $result_arr)) {
                echo "customerInfo子域：<br>\n";
                $customerInfo = com\unionpay\acp\sdk\AcpService::parseCustomerInfo($result_arr["customerInfo"]);
                if (array_key_exists("phoneNo", $customerInfo)) {
                    $phoneNo = $customerInfo["phoneNo"]; //customerInfo其他子域均可参考此方式获取
                }
                foreach ($customerInfo as $key => $value) {
                    echo $key . "=" . $value . "<br>\n";
                }
            }
        } else if ($result_arr["respCode"] == "77") {
            //未开通
            echo "未开通<br>\n";
        } else {
            //其他应答码做以失败处理
            echo "失败：" . $result_arr["respMsg"] . "。<br>\n";
        }
    }

    /**
     * 开通银联支付接口
     * 银联测开通
     */
    static function frontOpen($params) {
        com\unionpay\acp\sdk\AcpService::sign($params);
        $url = com\unionpay\acp\sdk\SDKConfig::getSDKConfig()->frontTransUrl;
        $html_form = com\unionpay\acp\sdk\AcpService::createAutoFormHtml($params, $url);
        LogServer::payLog($url, $params, $html_form); //页面打印请求应答数据
        echo $html_form;
    }

}
