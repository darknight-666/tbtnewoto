<?php

/**
 * 支付接口dome
 */
class PayController extends CustomerBaseController {

    /**
     * 检测银行卡是否开通银联支付
     */
    public function actionIndex() {
        $model = new UnionPay();
        $orderId = '20170831123456';
        $txnTime = date('YmdHis'); //YYYYMMDDhhmmss
        $accNo = '6226090000000048';
        $ret = UnionPayApi::openQuery($model->openQuery($orderId, $txnTime, $accNo));
        print_r($ret);
    }

    /**
     * 开通银联支付---银联测开通
     */
    public function actionFrontOpen() {
        $model = new UnionPay();
        //TODO 银行卡信息
        $customerInfo = array(
            'phoneNo' => '18100000000', //手机号
            'certifTp' => '01', //证件类型，01-身份证
            'certifId' => '510265790128303', //证件号，15位身份证不校验尾号，18位会校验尾号，请务必在前端写好校验代码
            'customerNm' => '张三', //姓名
            'smsCode' => '654321', //短信验证码，测试环境不会真实收到短信，固定填111111。除了123456和654321固定反失败，其余固定成功。
        );
        $orderId = '20170831123456';
        $txnTime = date('YmdHis'); //YYYYMMDDhhmmss
        $accNo = '6226090000000048';
        $ret = UnionPayApi::frontOpen($model->frontOpen($orderId, $txnTime, $accNo, $customerInfo));
        print_R($ret);
    }

    /**
     * 支付接口测试
     */
    public function actionPayment() {
        $model = new UnionPay();
        //TODO 银行卡信息
        $customerInfo = array(
            'phoneNo' => '18100000000', //手机号
            'certifTp' => '01', //证件类型，01-身份证
            'certifId' => '510265790128303', //证件号，15位身份证不校验尾号，18位会校验尾号，请务必在前端写好校验代码
            'customerNm' => '张三', //姓名
        );
        $orderId = '20170831123456';
        $txnTime = date('YmdHis'); //YYYYMMDDhhmmss
        $accNo = '6226090000000048';
        $txnAmt = '1';
        $ret = UnionPayApi::payment($model->payment($orderId, $txnTime, $accNo, $txnAmt, $customerInfo));
        print_R($ret);
    }

    /**
     * 退款接口测试
     */
    public function actionRefund() {
        $model = new UnionPay();
        $orderId = '20170831123456';
        $txnTime = date('YmdHis'); //YYYYMMDDhhmmss
        $txnAmt = '3000';
        $origQryId = '20170831123456'; //支付流水号
        $ret = UnionPayApi::refund($model->refund($orderId, $txnTime, $txnAmt, $origQryId));
        print_R($ret);
    }
    /**
     * 开通回调页面
     */
    public function actionOpenBack(){
        $this->render('openBack');
    }
    /**
     * 支付回调页面
     */
    public function actionPayBack(){
        $this->render('payBack');
    }
    /**
     * 接收开通结果
     * activateStatus 
     * 0为开通
     * 1已开通银联全渠道支付
     * 2已开通小额认证支付
     * 3评级开通
     */
    public function actionReceiveOpenBack(){
        $result = $_REQUEST;
        LogServer::payLog('银联返回开通结果', '', $_REQUEST); 
        if(isset($result['activateStatus']) && $result['activateStatus'] == 1){
            LogServer::payLog('银联返回开通结果', '', $result['respMsg']); 
        }else{
            LogServer::payLog('银联返回开通结果--失败', '', $_REQUEST); 
        }
        
    }
    /**
     * 接收支付结果
     */
    public function actionReceivePayBack(){
        LogServer::payLog('银联返回支付结果', '', $_REQUEST); 
    }
    /**
     * 接收退货结果
     */
    public function actionRefundPayBack(){
        LogServer::payLog('接收退货结果', '', $_REQUEST); 
    }
}
