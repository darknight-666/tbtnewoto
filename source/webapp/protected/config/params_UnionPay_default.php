<?php

/**
 * 银联支付配置文件
 */
if (YII_TBTENV == 1) {//生产
    return array(
        'merId' => '',
        'acpsdk' => array(
            'acpsdk.frontTransUrl' => 'https://gateway.95516.com/gateway/api/frontTransReq.do',
            'acpsdk.backTransUrl' => 'https://gateway.95516.com/gateway/api/backTransReq.do',
            'acpsdk.singleQueryUrl' => 'https://gateway.95516.com/gateway/api/queryTrans.do',
            'acpsdk.batchTransUrl' => 'https://gateway.95516.com/gateway/api/batchTrans.do',
            'acpsdk.fileTransUrl' => 'https://filedownload.95516.com/',
            'acpsdk.appTransUrl' => 'https://gateway.95516.com/gateway/api/appTransReq.do',
            'acpsdk.cardTransUrl' => 'https://gateway.95516.com/gateway/api/cardTransReq.do',
            'acpsdk.jfFrontTransUrl' => 'https://gateway.95516.com/jiaofei/api/frontTransReq.do',
            'acpsdk.jfBackTransUrl' => 'https://gateway.95516.com/jiaofei/api/backTransReq.do',
            'acpsdk.jfSingleQueryUrl' => 'https://gateway.95516.com/jiaofei/api/queryTrans.do',
            'acpsdk.jfCardTransUrl' => 'https://gateway.95516.com/jiaofei/api/cardTransReq.do',
            'acpsdk.jfAppTransUrl' => 'https://gateway.95516.com/jiaofei/api/appTransReq.do',
            'acpsdk.version' => '5.1.0',
            'acpsdk.signMethod' => '01',
            'acpsdk.ifValidateRemoteCert' => '1',
            'acpsdk.backUrl' => 'http://222.222.222.222:8080/upacp_demo_wtz/demo/api_03_wtz/BackReceive.php',
            'acpsdk.frontUrl' => 'http://localhost:8086/upacp_demo_wtz/demo/api_03_wtz/FrontReceive.php',
            'acpsdk.signCert.path' => 'D:/certs/从cfca获取到的私钥证书.pfx',
            'acpsdk.signCert.pwd' => '000000',
            'acpsdk.encryptCert.path' => 'd:/certs/acp_prod_enc.cer',
            'acpsdk.middleCert.path' => 'D:/certs/acp_prod_middle.cer',
            'acpsdk.rootCert.path' => 'D:/certs/acp_prod_root.cer',
            'acpsdk.log.file.path' => 'D:/logs/',
            'acpsdk.log.level' => 'INFO',
        ),
    );
} else if (YII_TBTENV == 2) {//测试
    return array(
        'iniConfigPath' => 'acp_sdk_pro.ini', // ini配置文件名
        'merId' => '777290058110097',
        'acpsdk' => array(
            'acpsdk.frontTransUrl' => 'https://gateway.test.95516.com/gateway/api/frontTransReq.do',
            'acpsdk.backTransUrl' => 'https://gateway.test.95516.com/gateway/api/backTransReq.do',
            'acpsdk.singleQueryUrl' => 'https://gateway.test.95516.com/gateway/api/queryTrans.do',
            'acpsdk.batchTransUrl' => 'https://gateway.test.95516.com/gateway/api/batchTrans.do',
            'acpsdk.fileTransUrl' => 'https://filedownload.test.95516.com/',
            'acpsdk.appTransUrl' => 'https://gateway.test.95516.com/gateway/api/appTransReq.do',
            'acpsdk.cardTransUrl' => 'https://gateway.test.95516.com/gateway/api/cardTransReq.do',
            'acpsdk.jfFrontTransUrl' => 'https://gateway.test.95516.com/jiaofei/api/frontTransReq.do',
            'acpsdk.jfBackTransUrl' => 'https://gateway.test.95516.com/jiaofei/api/backTransReq.do',
            'acpsdk.jfSingleQueryUrl' => 'https://gateway.test.95516.com/jiaofei/api/queryTrans.do',
            'acpsdk.jfCardTransUrl' => 'https://gateway.test.95516.com/jiaofei/api/cardTransReq.do',
            'acpsdk.jfAppTransUrl' => 'https://gateway.test.95516.com/jiaofei/api/appTransReq.do',
            'acpsdk.version' => '5.1.0',
            'acpsdk.signMethod' => '01',
            'acpsdk.ifValidateCNName' => '',
            'acpsdk.ifValidateRemoteCert' => '',
            'acpsdk.backUrl' => 'http://222.222.222.222:8080/upacp_demo_wtz/demo/api_03_wtz/BackReceive.php',
            'acpsdk.frontUrl' => 'http://api.o.test/shop/default/index',
            'acpsdk.signCert.path' => '/Users/wangchunyan05/Sites/project/tbtnewoto/source/webapp/protected/extensions/UnionPay/certs/test/acp_test_sign.pfx',
            'acpsdk.signCert.pwd' => '000000',
            'acpsdk.encryptCert.path' => '/Users/wangchunyan05/Sites/project/tbtnewoto/source/webapp/protected/extensions/UnionPay/certs/test/acp_test_enc.cer',
            'acpsdk.middleCert.path' => '/Users/wangchunyan05/Sites/project/tbtnewoto/source/webapp/protected/extensions/UnionPay/certs/test/acp_test_middle.cer',
            'acpsdk.rootCert.path' => '/Users/wangchunyan05/Sites/project/tbtnewoto/source/webapp/protected/extensions/UnionPay/certs/test/acp_test_root.cer',
            'acpsdk.log.file.path' => '/Users/wangchunyan05/Sites/project/tbtnewoto/source/webapp/protected/runtime/logs/',
            'acpsdk.log.level' => 'DEBUG',
        ),
    );
} else if (YII_TBTENV == 3) {//转生产
    return array(
        'merId' => '',
        'acpsdk' => array(
            'acpsdk.frontTransUrl' => 'https://gateway.95516.com/gateway/api/frontTransReq.do',
            'acpsdk.backTransUrl' => 'https://gateway.95516.com/gateway/api/backTransReq.do',
            'acpsdk.singleQueryUrl' => 'https://gateway.95516.com/gateway/api/queryTrans.do',
            'acpsdk.batchTransUrl' => 'https://gateway.95516.com/gateway/api/batchTrans.do',
            'acpsdk.fileTransUrl' => 'https://filedownload.95516.com/',
            'acpsdk.appTransUrl' => 'https://gateway.95516.com/gateway/api/appTransReq.do',
            'acpsdk.cardTransUrl' => 'https://gateway.95516.com/gateway/api/cardTransReq.do',
            'acpsdk.jfFrontTransUrl' => 'https://gateway.95516.com/jiaofei/api/frontTransReq.do',
            'acpsdk.jfBackTransUrl' => 'https://gateway.95516.com/jiaofei/api/backTransReq.do',
            'acpsdk.jfSingleQueryUrl' => 'https://gateway.95516.com/jiaofei/api/queryTrans.do',
            'acpsdk.jfCardTransUrl' => 'https://gateway.95516.com/jiaofei/api/cardTransReq.do',
            'acpsdk.jfAppTransUrl' => 'https://gateway.95516.com/jiaofei/api/appTransReq.do',
            'acpsdk.version' => '5.1.0',
            'acpsdk.signMethod' => '01',
            'acpsdk.ifValidateRemoteCert' => '1',
            'acpsdk.backUrl' => 'http://222.222.222.222:8080/upacp_demo_wtz/demo/api_03_wtz/BackReceive.php',
            'acpsdk.frontUrl' => 'http://localhost:8086/upacp_demo_wtz/demo/api_03_wtz/FrontReceive.php',
            'acpsdk.signCert.path' => 'D:/certs/从cfca获取到的私钥证书.pfx',
            'acpsdk.signCert.pwd' => '000000',
            'acpsdk.encryptCert.path' => 'd:/certs/acp_prod_enc.cer',
            'acpsdk.middleCert.path' => 'D:/certs/acp_prod_middle.cer',
            'acpsdk.rootCert.path' => 'D:/certs/acp_prod_root.cer',
            'acpsdk.log.file.path' => 'D:/logs/',
            'acpsdk.log.level' => 'INFO',
        ),
    );
}

