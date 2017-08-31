<?php
$this->pageTitle = Yii::app()->name . ' - 商户账户添加账号';
$this->module->params = array('title' => '商户账户添加账号', 'title_img' => 'fa-th', 'icon' => '');
$menu = $this->getAction()->getId();
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">商户账号管理 </h3>
    </div>
    <div class="panel-body">
        <!--        品牌-->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="CrmManager_proxyId">品牌：</label>

                <div class="from-control">
                    <div class="select">
                        <div class="select-wrap">
                            <select name="CrmManager[networkId]" id="CrmManager_networkId">
                                <option value="">请选择...</option>
                                <option value="">...</option>
                                <option value="">...</option>
                            </select></div>
                    </div>
                </div>
            </div>
            <!--            门店-->
            <div class="section">
                <div class="from-group">
                    <label class="control-label required" for="CrmManager_networkId">门店：<span
                            class="required">*</span></label>

                    <div class="from-control">
                        <div class="select">
                            <div class="select-wrap">
                                <select name="CrmManager[networkId]" id="CrmManager_networkId">
                                    <option value="">请选择...</option>
                                    <option value="">...</option>
                                    <option value="">...</option>
                                </select></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--            账号(手机号)：-->
            <div class="section">
                <div class="from-group">
                    <label class="control-label" for="CrmManager_phonenum">账号(手机号)：</label>

                    <div class="from-control">
                        <div class="input">
                            <input autocomplete="off" maxlength="11" name="CrmManager[phonenum]"
                                   id="CrmManager_phonenum" type="text"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="btn-panel">
    <div class="btn-wrap">
        <input class="btn btn-primary" id="submit_form" name="yt0" value="添加" type="submit"></div>
</div>