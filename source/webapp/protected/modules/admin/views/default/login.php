<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="UTF-8">
        <title>登录</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->params['site']['cdnUrl'] . "/resource/css/reset.css?" . Yii::app()->params['site']['staticVersion']); ?>
        <style type="text/css">
            /*----------------------------------------------------------------------*/
            /* login page style
            /*----------------------------------------------------------------------*/
            html,
            body {
                height: 100%;
            }

            body {
                width: 100%;
                overflow: hidden;
                background-color: #3e93ed;
                /*            background: #3e93ed url("*/<?php //echo Yii::app()->params['site']['cdnUrl'] . "/resource/img/login_system_tit.gif";  ?>/*") no-repeat 50px center;*/
            }

            input::-webkit-input-placeholder {
                color: #9a9b9d;
            }

            input::-moz-placeholder {
                color: #9a9b9d;
            }

            input:focus::-webkit-input-placeholder {
                color: #9a9b9d;
            }

            input:focus::-moz-placeholder {
                color: #9a9b9d;
            }
            #login-page {
                position: relative;
                width: 100%;
                height: 100%;
                overflow: scroll;
            }
            #login-page .login-logo {
                position: relative;
                top: 50px;
                left: 50px;
                width: 367px;
                height: 56px;
                background: url("<?php echo Yii::app()->params['site']['cdnUrl'] . "/resource/img/login_logo_bg.png"; ?>") no-repeat;
                /*            _background: url("*/<?php //echo Yii::app()->params['site']['cdnUrl'] . "/resource/img/login_logo_bg.gif";  ?>/*") no-repeat;*/
                z-index: 5;
            }
            #login-page .login-main {
                position: relative;
                width: 1320px;
                height: 616px;
                overflow: hidden;
                margin: 2% auto 0;
                padding-right: 40px;
            }
            #login-page .login-system-title {
                float: left;
                width: 750px;
                height: 616px;
                background: url("<?php echo Yii::app()->params['site']['cdnUrl'] . "/resource/img/login_system_tit.gif"; ?>") no-repeat;
            }

            #login-page .login-form {
                float: right;
                width: 450px;
                height: 400px;
                padding: 10px;
                background: #59a1ed;
                margin-top: 70px;
            }

            #login-page .fieldset-inner {
                width: 450px;
                height: 350px;
                padding: 50px 0 0;
                background-color: #fff;
            }

            #login-page .fieldset {
                width: 360px;
                margin: 0 auto;
                overflow: hidden;
            }

            #login-page .fieldset .section {
                position: relative;
                margin-bottom: 30px;
            }

            #login-page .fieldset .section .input {
                position: relative;
                height: 44px;
                border-radius: 6px;
                bakground: #dfdfdf;
            }

            #login-page .fieldset .section .input input {
                display: block;
                width: 290px;
                height: 22px;
                padding: 11px 5px 11px 65px;
                border-right: 4px;
                background-color: #dfdfdf;
                font: 14px/20px 'Open Sans', Helvetica, Arial, sans-serif;
                /*color: #404040;*/
                vertical-align: middle;
                outline: 0 none;
            }

            #login-page .fieldset .section .input .placeholder {
                color: #9a9b9d;
            }

            #login-page .fieldset .section .yzm input {
                width: 200px;
            }

            #login-page .fieldset .section .yzm_wrap {
                height: 44px;
            }

            #login-page .fieldset .section .yzm {
                float: left;
            }

            #login-page .fieldset .section #veryCode {
                float: left;
            }

            #login-page .fieldset .section .errorMessage {
                position: absolute;
                color: #ed1c24;
                bottom: -22px;
                left: 0;
                padding-left: 65px;
            }

            #login-page .icon-append {
                position: absolute;
                top: 0;
                left: 0;
                width: 60px;
                height: 44px;
                *height: 45px;
                _height: 46px;
                font-size: 14px;
                background-color: #3e93ed;

            }

            #login-page .icon-append .icon {
                display: inline-block;
                width: 32px;
                height: 32px;
                margin: 6px 0 0 13px;
                background: url("<?php echo Yii::app()->params['site']['cdnUrl'] . "/resource/img/tbt_sp.png"; ?>") no-repeat;
                _background: url("<?php echo Yii::app()->params['site']['cdnUrl'] . "/resource/img/tbt_sp.gif"; ?>") no-repeat;
            }

            #login-page .input .icon-user {
                background-position: -22px 0;
            }

            #login-page .input .icon-lock {
                background-position: -22px -32px;
            }

            #login-page .input .icon-edit {
                background-position: -22px -64px;
            }

            #login-page .login-footer {
                text-align: center;
            }

            #login-page .login-footer .submit {
                width: 220px;
                height: 44px;
                border-radius: 4px;
                cursor: pointer;
                color: #fff;
                background-color: #66d354;
                font-weight: bold;
                outline: none;
                font-size: 16px;
                font-family: "Microsoft Yahei", "微软雅黑", Helvetica, Arial, sans-serif;
            }

            #login-page .login-footer .submit:link,
            #login-page .login-footer .submit:visited,
            #login-page .login-footer .submit:hover,
            #login-page .login-footer .submit:active {
                color: #fff;
                background-color: #66d354;
                outline: none;
            }

            .login-footer .btn-link {
                margin-top: 10px;
                font-size: 14px;
                text-align: center;
                line-height: 20px;
            }

            .login-footer .btn-link a {
                color: #3e93ed;
                text-decoration: underline;
            }
        </style>
    </head>
    <body onload="pageload();">
        <div id="login-page">
            <div class="login-logo"></div>

            <div class="login-main">
                <div class="login-system-title"></div>
                <div class="login-form">
                    <div class="fieldset-inner">
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'login-form',
                            'htmlOptions' => array('class' => 'smart-form client-form'),
//                    'enableClientValidation' => true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                            ),
                        ));
                        ?>
                        <div class="fieldset">
                            <div class="section">
                                <div class="input">
                                    <div class="icon-append"><i class="icon icon-user"></i></div>
                                    <?php echo $form->textField($model, 'username', array('placeholder' => '用户名')); ?>
                                    <?php echo $form->error($model, 'username'); ?>
                                    <div class="errorMessage"></div>
                                </div>
                            </div>
                            <div class="section">
                                <div class="input">
                                    <div class="icon-append"><i class="icon icon-lock"></i></div>
                                    <?php echo $form->passwordField($model, 'password', array('placeholder' => '密码')); ?>
                                    <?php echo $form->error($model, 'password'); ?>
                                    <div class="errorMessage"></div>
                                </div>
                            </div>
                            <div class="section">
                                <div class="yzm_wrap">
                                    <div class="input yzm">
                                        <div class="icon-append"><i class="icon icon-edit"></i></div>
                                        <?php echo CHtml::activeTextField($model, 'verifyCode', array('placeholder' => '验证码')); ?>
                                        <?php echo $form->error($model, 'verifyCode'); ?>
                                        <div class="errorMessage"></div>
                                    </div>
                                    <?php
                                    $this->widget('CCaptcha', array(
                                        'imageOptions' => array('style' => 'cursor:pointer;width:90px;height:40px;display:inline-block;padding-top:5px;', 'id' => 'veryCode'),
                                        'clickableImage' => true,
                                        'buttonLabel' => '',
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="login-footer t-center">
                            <button type="submit" class="submit" id="loginBtn">登录</button>
                        </div>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->params['site']['cdnUrl'] . "/resource/js/jquery.min.js?" . Yii::app()->params['site']['staticVersion'], CClientScript::POS_END); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->params['site']['cdnUrl'] . "/resource/js/jquery.yiiactiveform.js?" . Yii::app()->params['site']['staticVersion'], CClientScript::POS_END); ?>
        <!--[if IE 6]>
        <script src="/resource/js/DD_belatedPNG.js"></script>
        <script>
            DD_belatedPNG.fix('.login-logo,img');
        </script>
        <![endif]-->
        <script>
        </script>
</html>