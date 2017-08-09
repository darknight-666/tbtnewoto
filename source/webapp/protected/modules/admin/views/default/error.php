<?php
$this->module->tableIcon = false;
$this->pageTitle = Yii::app()->name . ' - 页面出错';
$this->module->params = array('title' => '');
?>
<?php if ($code == 404): ?>
	<div class="tbt-panel">
		<div class="panel-header">
			<h3 class="panel-title">页面出错</h3>
		</div>
		<div class="panel-body">
			<div class="alert alert-danger">
				<div style="font-size: 18px;font-weight: 600;"><i class="icon icon-alert"></i>Error 404</div>
				<p>对不起，您访问的页面不存在</p>
			</div>
			<div class="note">
				您要查看的网址可能已被删除、地址已更改，或者暂时不可用。您可以使用浏览器的<b><u>返回</u></b>按钮返回之前的页面。
				如果还有问题，请直接联系我们：010-62574016。
			</div>
		</div>
	</div>
<?php else:?>
	<div class="tbt-panel">
		<div class="panel-header">
			<h3 class="panel-title">页面出错</h3>
		</div>
		<div class="panel-body">
			<div class="alert alert-danger">
				<div style="font-size: 18px;font-weight: 600;"><i class="icon icon-alert"></i>Forbidden</div>
				<p>对不起, 访问受限!</p>
			</div>
			<div class="note">服务器拒绝了您的浏览请求，请确认您是否拥有所需的访问权限。</div>
		</div>
	</div>
<?php endif; ?>
<?php //Yii::app()->clientScript->registerCssFile(Yii::app()->params['site']['cdnUrl'] . "/resource/css/tbt-error.css?" . Yii::app()->params['site']['staticVersion']); ?>
<script type="text/javascript">
	$(function(){
		var url=window.location.href;
			if (url.indexOf('404')>0) {
				$("#ribbon .breadcrumb").empty().append('<li>页面出错</li>')
			}
			if(url.indexOf('403')>0){
				$("#ribbon .breadcrumb").empty().append('<li>没有权限</li>')
			};
	})
</script>
