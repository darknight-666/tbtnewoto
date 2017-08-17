<?php

if (YII_TBTENV == 1) { // 生产
    return array(
        'user' => 'viptbd100',
        'password' => 'GSWarriors2015!',
        'url' => 'http://222.73.117.158/msg/HttpBatchSendSM',
        'signature' => '',
        'lenth' => '304',
        'environment' => false, // false：关闭测试 true：开启测试
        'phonenumberTest' => '15901029703', // 测试专用接收短信手机号码
    );
}

if (YII_TBTENV == 2) { // 测试
    return array(
        'user' => 'viptbd100',
        'password' => 'GSWarriors2015!',
        'url' => 'http://222.73.117.158/msg/HttpBatchSendSM',
        'signature' => '',
        'lenth' => '304',
        'environment' => true, // false：关闭测试 true：开启测试
        'phonenumberTest' => '15901029703', // 测试专用接收短信手机号码
    );
}

if (YII_TBTENV == 3) { // 准生产
    return array(
        'user' => 'viptbd100',
        'password' => 'GSWarriors2015!',
        'url' => 'http://222.73.117.158/msg/HttpBatchSendSM',
        'signature' => '',
        'lenth' => '304',
        'environment' => true, // false：关闭测试 true：开启测试
        'phonenumberTest' => '15901029703', // 测试专用接收短信手机号码
    );
}

