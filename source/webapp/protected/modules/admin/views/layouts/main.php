<!DOCTYPE html>
<html>
    <head lang="zh-CN">
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->params['site']['cdnUrl'] . "/resource/js/jquery-ui-1.9.2.custom/css/smoothness/jquery-ui-1.9.2.custom.css?" . Yii::app()->params['site']['staticVersion']); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->params['site']['cdnUrl'] . "/resource/css/reset.css?" . Yii::app()->params['site']['staticVersion']); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->params['site']['cdnUrl'] . "/resource/css/style.css?" . Yii::app()->params['site']['staticVersion']); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->params['site']['cdnUrl'] . "/resource/css/printstyle.css?" . Yii::app()->params['site']['staticVersion']); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->params['site']['cdnUrl'] . "/resource/css/stylesheet.css?" . Yii::app()->params['site']['staticVersion']); ?>
    </head>
    <body>
        <div id="voice"></div>
        <!-- header -->
        <div id="tbtHead">
            <div class="header">
                <!-- logo/version -->
                <h1 class="logo"><a href="#"><img src="<?php echo Yii::app()->params['site']['cdnUrl'] . "/resource/img/logo.jpg"; ?>" alt="通宝图"/></a></h1>
                <h2 class="version"><?php echo $this->module->getName(); ?></h2>
                <!-- rightNav -->
                <ul class="nav">
<!--                    <li class="nav-item message">
                        <a href='/tong/default/message'>
                            消息
                            <i class="message-icon">
                                <span class="arrow"><?php // echo $this->messNum;    ?></span>
                            </i>
                        </a>
                    </li>-->
                    <li class="nav-item user">
                        <a href="javascript:;" id="show-roleList" class="auser">
                            <i class="user-icon"></i>
                            欢迎，<?php echo Yii::app()->user->name; ?>
                        </a>
                        <div class="role-select" id="roleList">
                            <span class="arrow"></span>
                            <ul class="role-list">
                                <li>
                                    <a href="/<?php echo ($this->module->getId() == 'tong' ? 'tong/' : $this->module->getId() . '/'); ?>default/updatePassword" class="active">
                                        <i class="icon icon20 icon-user"></i>
                                        修改密码
                                    </a>
                                </li>
                                <li>
                                    <a href="/<?php echo $this->module->getId() . '/'; ?>default/agreement" class="active">
                                        <i class="icon icon20 icon-user"></i>
                                        服务协议
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item line"></li>
                    <li class="nav-item logout"><a href="javascript:;">退出</a></li>
                </ul>
            </div>
        </div>
        <!-- content -->
        <div id="tbtContainerWrap">
            <div class="tbtContainer">
                <!-- leftbar -->
                <div id="tbtLeft">
                    <div class="nav" id="tbt_left_nav">
                        <?php
                        $this->widget('application.components.TNav', array('items' => $this->module->menus, 'htmlOptions' => array('class' => 'parent-ul')));
                        ?>
                    </div>
                </div>
                <!-- main -->
                <div id="tbtMain">
                    <div class="main">
                        <div class="breadnav">
                            <i class="icon icon-wz"></i>
                            <span id="tbt_bread_one" class="bread-one" ><?php echo $this->module->params['title']; ?></span>
                            <span class="line">/</span>
                            <span id="tbt_bread_two" class="bread-two"></span>
                        </div>
                        <div class="content">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <!-- footer -->
        <div id="tbtFooter">
            <p>Copyright © 2014 - All right reserved - 通宝图 &nbsp;&nbsp; ICP备案号：京ICP备第14003088号</p>
            <p>北京通宝图金融信息服务有限公司 &nbsp;&nbsp; 客服电话：400-870-8881   E-Mail：info@tongbaotu.com</p>
        </div>
        <!--退出系统弹出框-->
        <!-- logout-model -->
        <div id="logoutModal" class="logout-model">
            <div class="modal-dialog">
                <div class="modal-header">
                    <h4 class="modal-title">退出？</h4>
                </div>
                <div class="modal-body">
                    <p class="t-center">通过退出关闭浏览器，可以提高安全性！</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="logout-yes">是</button>
                    <button class="btn btn-line" id="logout-close">否</button>
                </div>
            </div>
        </div>
        <input type="hidden" id="tbt_product_id"/>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->params['site']['cdnUrl'] . "/resource/js/jquery.min.js?" . Yii::app()->params['site']['staticVersion']); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->params['site']['cdnUrl'] . "/resource/js/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.js?" . Yii::app()->params['site']['staticVersion']); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->params['site']['cdnUrl'] . "/resource/js/tbt.js?" . Yii::app()->params['site']['staticVersion'], CClientScript::POS_END); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->params['site']['cdnUrl'] . "/resource/js/jquery.yiiactiveform.js?" . Yii::app()->params['site']['staticVersion'], CClientScript::POS_END); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->params['site']['cdnUrl'] . "/resource/js/jquery.yii.js?" . Yii::app()->params['site']['staticVersion'], CClientScript::POS_END); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->params['site']['cdnUrl'] . "/resource/js/ajaxupload.js?" . Yii::app()->params['site']['staticVersion'], CClientScript::POS_END); ?>
        <script>
            $(function () {
                var menu = "<?php echo!empty($_REQUEST['menu']) ? $_REQUEST['menu'] : ''; ?>";
                var controller = "<?php echo Yii::app()->controller->id; ?>";
                var action = "<?php echo $this->getAction()->getId(); ?>";
                var nameVal = controller + '.' + action;
                var actionObj = $('#tbt_left_nav li[name="' + nameVal + '"]');
                if (actionObj) {
                    var tbtBreadtwoHtml = actionObj.text();
                    var tbtBreadOneHtml = actionObj.parents('.parent').children('a').find('span.menu-item').text();
                    if (tbtBreadtwoHtml == '' && tbtBreadOneHtml == '') {
                        var namevalue = controller + '.' + menu;
                        actionObj = $('#tbt_left_nav li[name="' + namevalue + '"]');
                        var tbtBreadtwoHtml = actionObj.text();
                        var tbtBreadOneHtml = actionObj.parents('.parent').children('a').find('span.menu-item').text();
                    }
                    actionObj.addClass('active').parents('li').addClass('active open');
                    $('#tbt_bread_two').html(tbtBreadtwoHtml);
                    $('#tbt_bread_one').html(tbtBreadOneHtml);
                }
                ;
            });
        </script>
        <script>
            //edui-icon-fullscreen edui-icon 全屏问题
            $("body").delegate(".edui-icon-fullscreen", "click", function () {
                var id = $(".edui-body-container").attr('id');
                if (id === 'FormNews_contnet') {
                    $(".edui-body-container").attr({'id': ''});
                    $("select").hide();
                } else {
                    $(".edui-body-container").attr({'id': 'FormNews_contnet'});
                    $("select").show();
                }
            });
        </script>
    </body>
</html>