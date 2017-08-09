/**
 * 产品申请确认
 * edCheck_PIClear
 */
function edCheckPIClear(returnData) {
    if (returnData.data.items != null && returnData.data.items.length > 0) {
        var content = '<div style="font-size:12px;color:red;line-height: 30px;">**请运营人员提醒发行行做清算申请并对结果确认</div>';
        content += ' <table id="dt_basic" class="table table-striped mt20" width="100%">';
        content += ' <thead>';
        content += ' <tr>';
        content += ' <th>发行行ID</th>';
        content += ' <th>发行行名称</th>';
        content += '  <th data-hide="phone">产品ID</th>';
        content += ' <th data-class="expand">产品简称</th>';
        content += ' </tr>';
        content += '</thead>';
        content += ' <tbody>';
        var content1 = '';
        $.each(returnData.data.items, function(i, n) {
            content1 += ' <tr>';
            content1 += '<td>' + n.institutionId + '</td>';
            content1 += '<td>' + n.institutionName + '</td>';
            content1 += '<td>' + n.productId + '</td>';
            content1 += '<td>' + n.productAbbrName + '</td>';
            content1 += '</tr>';
        });
        var contentEnd = '';
        contentEnd += '</tbody>';
        contentEnd += '  </table>';
        $('.dataView').html(content + content1 + contentEnd);
    }
}



/****
 * 确认募集资金汇总
 * edCheck_PORaiseConfirm
 */
function edCheckPORaiseConfirm(returnData) {
    if ( returnData.data.items != null && returnData.data.items.length > 0) {
        var len = returnData.data.items.length;
        var content = '<div style="font-size:12px;line-height:30px;">**请运营人员提醒订购模式代销行对募集数据进行确认 <div style="text-align:center;color:red;">有'+len+'条数据未进行募集数据确认，<a class="btn-link" href="/tong/liquidanew/proxyOrderDetail/menu/finalDay" style="font-size:14px;">现在去处理</a></div></div>';
//        content += ' <table id="dt_basic" class="table table-striped mt20" width="100%">';
//        content += ' <thead>';
//        content += ' <tr>';
//        content += ' <th>代销行ID</th>';
//        content += ' <th>代销行名称</th>';
//        content += '  <th data-hide="phone">产品ID</th>';
//        content += ' <th data-class="expand">产品简称</th>';
//        content += ' <th data-class="expand">操作</th>';
//        content += ' </tr>';
//        content += '</thead>';
//        content += ' <tbody>';
//        var content1 = '';
//        $.each(returnData.data.items, function(i, n) {
//            content1 += ' <tr>';
//            content1 += '<td>' + n.institutionId + '</td>';
//            content1 += '<td>' + n.institutionName + '</td>';
//            content1 += '<td>' + n.productId + '</td>';
//            content1 += '<td>' + n.productAbbrName + '</td>';
//            content1 += '<td><a class="btn-link" href="/tong/liquidanew/proxyOrderDetail/menu/finalDay">详情</a></td>';
//            content1 += '</tr>';
//        });
//        var contentEnd = '';
//        contentEnd += '</tbody>';
//        contentEnd += '  </table>';
        $('.dataView').html(content);
    }
}



//检查外连模式认购确认
// PIRaiseConfirmCheck
function PIRasiseConfirmCheck(returnData) {
    if (returnData.data.items != null && returnData.data.items.length > 0) {
        var content = '';
        content += ' <table id="dt_basic" class="table table-striped mt20" width="100%">';
        content += ' <thead>';
        content += ' <tr>';
        content += ' <th>编码</th>';
        content += ' <th>发行行ID</th>';
        content += '  <th data-hide="phone">发行行名称</th>';
        content += ' <th data-class="expand">产品ID</th>';
        content += ' <th data-hide="phone">产品简称</th>';
        content += ' </tr>';
        content += '</thead>';
        content += ' <tbody>';
        var content1 = '';
        $.each(returnData.data.items, function(i, n) {
            content1 += ' <tr>';
            content1 += '<td>' + Number(i + 1) + '</td>';
            content1 += '<td>' + n.institutionId + '</td>';
            content1 += '<td>' + n.institutionName + '</td>';
            content1 += '<td>' + n.productId + '</td>';
            content1 += '<td>' + n.productAbbrName + '</td>';
            content1 += '</tr>';
        });

        var contentEnd = '';
        contentEnd += '</tbody>';
        contentEnd += '  </table>';
        $('.dataView').html(content + content1 + contentEnd);
    }
}
//****代销行应收资金汇总查询 代销行列表
    function queryAmountReceSum1(returnData) {
        if (returnData.data.items != null && returnData.data.items.length > 0) {
                    var content=' <table id="dt_basic9" class="table table-striped mt20" width="100%"> \n\
                        <thead>\n\
                        <tr>\n\
                        <th><input type="checkbox" id="selectList" onclick="clickFunction(this)"/></th>\n\
                        <th data-hide="phone">发行机构ID</th>\n\
                        <th data-class="expand">产品代码</th>\n\
                        <th data-hide="phone">到期日期</th>\n\
                        <th>代销机构ID</th><th>金额(元)</th>\n\
                        <th>代销费(元)</th><th>资金总额(元)</th>\n\
                        <th data-hide="phone,tablet">类型</th>\n\
                        <th data-hide="phone,tablet">状态</th> \n\
                        </tr></thead>\n\
                        <tbody>';
                     var content1 = '';
                    $.each(returnData.data.items, function (i, n) {
                        content1 += ' <tr>';
                        content1 += '<td style="text-align:center;"><input type="checkbox" name="item" checked="true" info=' + n.FundCode +"," +n.ProxyID+ ","+n.Type+' class="selectInfo"></td>';
                        content1 += '<td>' + n.IssuID + '</td>';
                        content1 += '<td>' + n.FundCode + '</td>';
                        content1 += '<td>' + n.EndDate + '</td>';
                        content1 += '<td>' + n.ProxyID + '</td>';
                        content1 += '<td>' + n.Amount + '</td>';
                        content1 += '<td>' + n.proxyFee + '</td>';
                        content1 += '<td>' + n.totalAmount + '</td>';
                        if (n.Type == '1') {
                            content1 += '<td>强制赎回</td>';
                        } else if (n.Type == '2') {
                            content1 += '<td>产品终止</td>';
                        }else if (n.Type == '9') {
                             content1 += '<td>周期分红</td>';
                        }else if (n.Type == '11') {
                             content1 += '<td>赎回</td>';
                        }
                        if (n.Status == '0') {
                            content1 += '<td>已通知</td>';
                        } else if (n.Status == '1') {
                            content1 += '<td>已兑付</td>';
                        }
                        content1 += '</tr>';

                    });
                    var contentend = '</tbody></table>\n\
                    <div class="btn-panel"><div class="btn-wrap">\n\
                    <input type="button" class="submitPro displayNone btn btn-primary" style = "margin-top:10px;" value="请提交选择的代销行"></div></div>\n\
                    ';
                    $('.dataView').html(content+content1+contentend);
                }
     }
     /**
      * 
      * @param {type} obj
      * @returns {undefined}
      */
     function clickFunction(obj) {
        var smObj = document.getElementsByName("item");
        if (obj.checked) {
            for (var i = 0; i < smObj.length; i++) {
                if (smObj[i].disabled == false) {
                    smObj[i].checked = true;
                }
            }
        } else {
            for (var i = 0; i < smObj.length; i++) {
                smObj[i].checked = false;
            }
        }

    }
    /*选择打个复选框 */
    $("body").delegate(".selectInfo", "click", function () {
           $('#selectList').removeAttr('checked');;
    });
    /**
     * 
     */
    $("body").delegate(".submitPro", "click", function () {
        var content = '';
        var eachNum = $("input[name='item']:checked");
        var len = eachNum.length;
        if (len == 0) {
            alert('请选择提交代销列表');
            return false;
        }
        $("input[name='item']:checkbox:checked").each(function (j) {
            var info = $(this).attr('info');
            if (j == Number(len - 1)) {
                content += info;
            } else {
                content += info + '//';
            }
        });
        $('#selectfuncId').val(content);
        $('.submitPro').attr({'style':'display:none'});
        
    });
/**
 * 日志显示
 */
function showOperlog() {
    var tip = $('#showlog').attr('tip');
    if (tip == 0) {
        var content1 = '<thead><tr><th width="60">编号</th>\n\
                                    <th data-hide="phone" width="80">操作人</th>\n\
                                    <th data-class="expand" width="100">操作时间</th> \n\
                                    <th data-hide="phone" width="100">业务日时间</th>\n\
                                    <th data-hide="phone">操作项</th></tr>\n\
                                    </thead><tbody class="tbody">';
        $.ajax({
            type: 'GET',
            url: '/tong/liquidanew/showlog',
            success: function(msg) {
                var msg =  eval("("+msg+")");
                var content = '';
                $.each(msg, function(i, n) {
                    content += '<tr>';
                    content += '<td>' + Number(i + 1) + '</td>';
                    content += '<td>' + n.name + '</td>';
                    content += '<td>' + n.last_time + '</td>';
                    content += '<td>' + n.systime + '</td>';
                    content += '<td> ';
                    $.each(n.loglist, function(j, m) {
                        content += m.description + ',';
                    });
                    content += '</td>';
                    content += '</tr>';
                });
                var content2 = '</tbody>';
                $('#dt_basic2').html(content1 + content + content2);
                $('#showlog').attr('tip', 1);
                $('#dt_basic2').show();
            }
        });
    } else {
        $('#dt_basic2').hide();
        $('#showlog').attr('tip', 0);
    }   
    }