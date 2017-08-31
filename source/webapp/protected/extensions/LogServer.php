<?php

/**
 * 记录日志
 */
class LogServer {
    /**
     * 记录支付消息日志
     * @param type $url
     * @param type $params
     * @param type $result
     */
    static function payLog($url,$params,$result) {
        $msg = '';
        $msg.="\nin " . 'url:' . $url;
        $msg.="\nin " . '参数:' . json_encode($params, JSON_UNESCAPED_UNICODE);
        if (!empty($result)) {
            $msg.="\nin " . '结果:' . json_encode($result, JSON_UNESCAPED_UNICODE);
        } else {
            $msg.="\nin " . '结果:' . json_encode($result, JSON_UNESCAPED_UNICODE);
        }
        Yii::log($msg, 'info', 'payinfo');
    }


}
