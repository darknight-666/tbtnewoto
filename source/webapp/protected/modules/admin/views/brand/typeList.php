<?php
$this->pageTitle = Yii::app()->name . ' - 品牌分类列表';
$this->module->params = array('title' => '品牌分类列表', 'title_img' => 'fa-th', 'icon' => '');
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">分类列表</h3>
        <div class="panel-btnWrap">
            <input class="btn btn-primary"  value="添加分类" type="button" id="btn-add">
        </div>
    </div>
    <div class="panel-body">
        <div class="section">
            <div class="from-group">
                <label class="control-label" for="">选择分类</label>
                <div class="from-control">
                    <div class="select">
                        <div class="select-wrap">
                            <div class="select">
                                <div class="select-wrap">
                                    <select  name="FormLiborCustomer[role]">
                                        <option value="">请选择...</option>
                                        <option value="41">餐饮</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">分类列表</h3>
    </div>
    <div class="panel-body">
        <table  class="table table-striped" width="100%">
            <thead><tr role="row" >
                <th>分类名称</th>
                <th>上一级分类</th>
                <th>商户数量（家）</th>
                <th>创建时间</th>
                <th>操作</th>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a class="btn-link" href="#">编辑</a>
                    <span class="sep">|</span>
                    <a class="btn-link return-btn"  href="javascript:;">删除</a>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a class="btn-link" href="#">编辑</a>
                    <span class="sep">|</span>
                    <a class="btn-link return-btn" href="javascript:;">删除</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(function(){
        /**
         *  添加分类
         */
        $("#btn-add").click(function(){
            var coursetypeId = $(this).attr("coursetypeid");
            $('#tbt_product_id').val(coursetypeId);
            $('#dialog-return').confirm({
                titleString: '',
                contentString: '<div class="from-group"><label for="" class="control-label">分类名称</label>  <input autocomplete="off"  type="text" style="width: 180px; height: 25px; line-height: 25px;   border: 1px solid #e6e5ea;padding: 0;margin: 0;"></div> ' +
                '<div class="from-group"><label class="control-label" for="">上级分类</label><select name="FormLiborCustomer[role]" style=" width: 180px;padding: 0;margin: 0;height: 25px; line-height: 25px;"> <option value="">请选择...</option> <option value="41">餐饮</option></select></div> ',
                 submitString: '添加',
                callback: 'updata(" ", "0", "0")'
            });
            return false;
        });
    });
</script>


