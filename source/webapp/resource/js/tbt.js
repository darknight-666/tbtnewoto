/**
 * Created by guoxiaoli on 2016/10/11.
 */
$(function () {
    sizeLayout();
    /**
     * table-striped
     */
    $(".table-striped").each(function(){
        $(this).find("tr:even").css('background','#f7f8fc');
    });

    /*
     tooltip effect
     */
    $(document).tooltip();

    /*
     logout system popbox
     */
    function logou() {
        $(".logout-model").hide();
        $(".logout-overlay").remove();
        $("select").removeClass("hide");
    }

    $('.logout').click(function () {
        $("select").addClass("hide");
        $("body").append('<div class="logout-overlay"><iframe class="overlay-iframe"></iframe></div>');
        $(".logout-overlay").height($(document).height());
        $(".overlay-iframe").height($(document).height());
        $('.logout-model').show();
    });

    $("#logout-yes").click(function () {
        var h = '/admin/default/logout';
        if (typeof($(this).attr('to')) != "undefined") {
            h = $(this).attr('to');
        }
        window.location.href = h;
        logou();
    });
    $("#logout-close").click(function () {
        logou();
    });

    /*
     imglist-pops
     */

    //$(".imglist-pop > .item").click(function(){
    //    //alert($(this).children().attr("awidth"))
    //    //alert($(this).children().attr("aheight"))
    //    //$("body").append('<div class="overlay"><iframe class="overlay-iframe"></iframe></div>');
    //    //$(".overlay").height($(document).height());
    //    //$(".overlay-iframe").height($(document).height());
    //});

    /*
     show-roleList
     */
    $("#show-roleList").click(function(){
        if($("#roleList").hasClass("in")){
            $("#roleList").removeClass("in").slideUp("fast");
            return false;
        }else {
            $("#roleList").addClass("in").slideDown("fast");
            return false;
        };
    });
    $(document).click(function (e) {
        var $targetDomain = $("#roleList");
        if (!$targetDomain.is(e.target) && $targetDomain.has(e.target).length === 0) {
            $("#roleList").removeClass("in").slideUp("fast");
        }
    });
    /*
     hover effect
     */

    function hover_action(object) {
        $(object).hover(function () {
            $(object).addClass("hover");
        }, function () {
            $(object).removeClass("hover");
        })
    }

    /*
     tablet pane slide(done)
     */

    tabBtnDisplay(0);

    $(".tablet-nav > .tablet").each(function () {
        $(this).click(function () {
            var idx = $(this).index();
            if (!$(this).hasClass("active")) {
                $(this).addClass("active").siblings().removeClass("active");
                $(".tablet-content .tab-pane").removeClass("in");
                $(".tablet-content .tab-pane").eq(idx).addClass("in");
            };
            tabBtnDisplay(idx);
        })
    });

    $('.tabBtn-prev').click(function(){
        var speed = -1;
        tabToggle(speed);
    });

    $('.tabBtn-next').click(function(){
        var speed = 1;
        tabToggle(speed);
    });

    function tabToggle(speed){
        var currentIndex;
        $(".tablet-nav > li").each(function(i){
            if($(this).hasClass("active")){
                currentIndex = i+speed;
            }
        });
        tabBtnDisplay(currentIndex);
        $(".tablet-nav > li").removeClass("active").eq(currentIndex).addClass("active");
        $(".tablet-content > div").removeClass("in").eq(currentIndex).addClass("in");
    };

    function tabBtnDisplay(index){
        switch(index){
            case 0 :
                $(".tabBtn-prev").hide();
                $(".tabBtn-next").show();
                $(".tabBtn-confirm").hide();
                break;
            case 3:
                $(".tabBtn-prev").show();
                $(".tabBtn-next").hide();
                $(".tabBtn-confirm").show();
                break;
            default :
                $(".tabBtn-prev").show();
                $(".tabBtn-confirm").hide();
                $(".tabBtn-next").show();
                break;
        };
    };

    /*
     nav menu effect(done)
     */


    $(".menu-item-parent").each(function () {
        var $this_parent = $(this).parent("li");

        if (!$this_parent.has("ul").length) {
            $this_parent.find("em.fa").remove();
        }

        $(this).click(function () {
            if (!$("body").hasClass("minified")) {
                if ($this_parent.hasClass("open")) {
                    $this_parent.removeClass("open");
                } else {
                    $this_parent.siblings().removeClass("open");
                    $this_parent.addClass("open");
                }
            }
            if (!$(this).attr('href')) {
                return false
            };
        })
    });

    $(".menu-item-second-parent").each(function(){
        var $this_parent = $(this).parent("li");

        if($this_parent.has("ul").length){
            if(!$(this).has("em.fa").length){
                $(this).append('<em class="fa"></em>');
            }
        }
        $(this).click(function(){
            if ($this_parent.hasClass("open")) {
                $this_parent.removeClass("open");
            } else {
                $this_parent.siblings().removeClass("open");
                $this_parent.addClass("open");
            };
        });
    });

    $(".minifyme").click(function () {
        $("body").addClass("minified");
        var isIE = !!window.ActiveXObject;
        var isIE6 = isIE && !window.XMLHttpRequest;
        if (isIE) {
            if (isIE6) {
                $("#left-panel li.parent").removeClass("open");
            }
        }
    });

    $(".back").click(function () {
        $("body").removeClass("minified");
    });

    $("#left-panel li").each(function () {
        hover_action(this);
    });

    // 客户经理关联确认弹出框功能
    $.fn.manager = function (options) {
        var default_options = {
            autoOpen: false,
            resizable: false,
            height: 200,
            width: 500,
            modal: true,
            html: '<div id="dialog-manager"><p>是否确认通过？</p></div>',
            callback: null,
            open: function (){

                $("select").addClass("hide");

            },
            close: function (event, ui) {
                $(default_options.html).empty();
                $(this).dialog('destroy').remove();
                $("select").removeClass("hide");

            },
            title: "<div class='widget-header'><h4>审核</h4></div>",
            buttons: [
                {
                    html: "通过",
                    "class": "btn btn-primary",
                    click: function () {
                        $(this).dialog("close");
                        removedialog();
                        if (default_options.callback != null) {
                            eval(default_options.callback);
                        }
                    }
                },
                {
                    html: "关闭",
                    "class": "btn btn-line",
                    click: function () {

                        $(this).dialog("close");
                        removedialog();
                    }
                }
            ]
        }

        if (options) {
            $.extend(default_options, options);
        }

        removedialog();
        $('body').append(default_options.html);
        $('#dialog-manager').dialog(default_options).dialog('open');

    }


    /*
     jqueryUI dialog
     */

    //        确认弹出框功能
    $.fn.confirm = function (options) {
        var default_options = {
            autoOpen: false,
            resizable: false,
            height: 250,
            width: 500,
            modal: true,
            html: '<div id="dialog-confirm"><p>是否确认通过？</p></div>',
            callback: null,
            titleString: null,
            htmlString: null,
            submitString: null,
            closeString: null,
            contentString: null,
            open: function (){
                $("select").addClass("hide");
            },
            close: function (event, ui) {
                $(default_options.html).empty();
                $(this).dialog('destroy').remove();
                $("select").removeClass("hide");
            },

            title: "<div class='widget-header'><h4>审核</h4></div>",
            buttons: [
                {
                    html: "通过",
                    "class": "btn btn-primary",
                    click: function () {
                        $(this).dialog("close");
                        removedialog();
                        if (default_options.callback != null) {
                            eval(default_options.callback);
                        }
                    }
                },
                {
                    html: "关闭",
                    "class": "btn btn-line",
                    click: function () {
                        $(this).dialog("close");
                        removedialog();
                    }
                }
            ]
        }

        if (options) {
            $.extend(default_options, options);
        }

        if (default_options.titleString != null) {
            default_options.title = "<div class='widget-header'><h4>" + default_options.titleString + "</h4></div>";
        }
        if (default_options.htmlString != null) {
            default_options.html = '<div id="dialog-confirm"><p>' + default_options.htmlString + '</p></div>';
        }
        if (default_options.contentString == null) {
            default_options.contentString = '是否确认通过？';
        }

        if (default_options.submitString != null) {
            default_options.buttons[0].html = default_options.submitString;
        }
        if (default_options.closeString != null) {
            default_options.buttons[1].html = default_options.closeString;
        }
        removedialog();
        $('body').append('<div id="dialog-confirm"> <p> ' + default_options.contentString + '</p> </div>');
        $('#dialog-confirm').dialog(default_options).dialog('open');
    }

    function removedialog() {
        $('#dialog-confirm').remove();
        $('#dialog-return').remove();
    }


    //  退回弹出框功能

    $.fn.returnback = function (options) {
        var default_options = {
            autoOpen: false,
            width: 500,
            height: 290,
            resizable: false,
            modal: true,
            titleString: null,
            htmlString: null,
            submitString: null,
            closeString: null,
            contentString: null,
            html: '<div id="dialog-return"><form><div class="textarea"><textarea rows="3" placeholder="请填写取消理由"></textarea><div class="errorMessage cancel-error-message">请输入退回理由</div></div></form></div>',
            callback: null,
            close: null,
            title: "<div class='widget-header'><h4>退回理由</h4></div>",
            buttons: [
                {
                    html: "确定",
                    "class": "btn btn-primary",
                    click: function () {
                        var cancel_content = $("#dialog-return").find("textarea").val();
                        $(".cancel-error-message").hide();


                        if (cancel_content == '') {

                            $(".cancel-error-message").show();
                        } else {
                            $(this).dialog("close");
                            $(".cancel-error-message").hide();

                            if (default_options.callback != null) {
                                eval(default_options.callback);
                            }
                            removedialog();
                        }
                    }
                },
                {
                    html: "取消",
                    "class": "btn btn-line",
                    click: function () {
                        $(this).dialog("close");
                        if (default_options.close != null) {
                            eval(default_options.close);
                        }
                        removedialog();
                    }
                }


            ]
        }

        if (options) {
            $.extend(default_options, options);
        }

        if (default_options.titleString != null) {
            default_options.title = "<div class='widget-header'><h4>" + default_options.titleString + "</h4></div>";
        }
        if (default_options.htmlString != null) {
            default_options.html = '<div id="dialog-return"><form><div class="textarea"><textarea rows="3" placeholder="' + default_options.htmlString + '"></textarea><div class="errorMessage cancel-error-message">' + default_options.htmlString + '</div></div></form></div>';
        }
        if (default_options.contentString == null) {
            default_options.contentString = '请输入退回理由';
        }

        if (default_options.submitString != null) {
            default_options.buttons[0].html = default_options.submitString;
        }
        if (default_options.closeString != null) {
            default_options.buttons[1].html = default_options.closeString;
        }

        removedialog();
        $('body').append('<div id="dialog-return"><form><div class="textarea"><textarea id="tbt_return_content" rows="3" placeholder="' + default_options.contentString + '"></textarea><div class="errorMessage cancel-error-message">' + default_options.contentString + '</div></div></form></div>');
        $('#dialog-return').dialog(default_options).dialog('open');
    }

    /*
     table print function
     */

    $(".print").click(function () {
        $("body").addClass("print-page")
    });

    $(".quit").click(function () {
        $("body").removeClass("print-page")
    });

    $(".print-finally").click(function () {
        $(".printmessage a").addClass("none");
        window.print();
        $(".printmessage a").removeClass("none");
    })

    /*
     progress bar
     */
    function progress_bar() {
        var $pre = $(".fuelux .pre"), $nex = $(".fuelux .nex"), $ul = $(".wizard .steps");
        var unit = $(".wizard .steps li").eq(0).outerWidth();
        var total_length = unit * $(".wizard .steps li").length;
        var wrapper_width = $(".wizard").width();
        var diff_width = wrapper_width - total_length;
        if (total_length > wrapper_width) {
            $nex.addClass("show");
            $pre.addClass("show");
        }

        $pre.click(function () {
            if (parseInt($ul.css("left")) < 0) {
                var current_left = parseInt($ul.css("left"));
                $ul.css("left", current_left + unit);
            }
        });

        $nex.click(function () {
            if (diff_width < parseInt($ul.css("left"))) {
                var current_left = parseInt($ul.css("left"));
                $ul.css("left", current_left - unit);
            }
        })
    }

    progress_bar();

    $(window).resize(function () {
        progress_bar();
    });

    /**
     * file-default components
     */

    $('.file-default .file-filed').change(function(){
        $('.file-default .input > input').val($(this).val());
    });

    /**
     * 根据下拉框选项 切换表单类型
     */
    formtypeToggle($('.form-type-select > select').val());

    $('.form-type-select > select').change(function(){
        var _value = $(this).val();
        formtypeToggle(_value);
    });

    function formtypeToggle(value){
        var $allElement = $(".form-type-group > div");
        var $selectType = $(".form-type-group").find(".select");
        var $inputType = $(".form-type-group").find(".input");
        switch (value){
            case 'selectType':
                $allElement.hide();
                $selectType.show();
                break;
            case 'inputType':
                $allElement.hide();
                $inputType.show();
                break;
        };
    };

    /**
     * 表单校验
     */
    $('body').delegate('.percent-checked','keyup',function(){
        isNumber($(this));
    });
    $('body').delegate('.percent-checked','blur',function(){
        var _value = $(this).val() == ''?'':limitDigit($(this).val());
        $(this).val(_value);
    });

    $('body').delegate('.integer-checked','keyup',function(){
        isInteger($(this));
    });

    $('body').delegate('.number-checked','keyup',function(){
        isNumber($(this));
    });

    function isNumber(obj){
        var reg = /^\d+(\.\d*)?$/;
        var value = obj.val();
        if(!reg.test(value)){
            obj.val("");
        }
    };

    function isInteger(obj){
        var reg=/^-?\d+$/;
        var value = obj.val();

        if(!reg.test(value)){
            if(value.length == 1 && value == '-'){
                obj.val("-");
            }else {
                obj.val("");
            }
        };
    };

    function limitDigit(val){
        val = val.replace(/^(\d*)$/, "$1.");
        val = (val + "00").replace(/(\d*\.\d\d)\d*/, "$1");
        val = val.replace(".", ",");
        var re = /(\d)(\d{3},)/;
//        while (re.test(val))
//            val = val.replace(re, "$1,$2");
        val = val.replace(/,(\d\d)$/, ".$1");
        return val.replace(/^\./, "0.");
    };

    $("input:checkbox[class*='allChk']").change(function(){
        var _isChecked = $(this).prop("checked");
        $("input:checkbox[class*='itemChk']").prop("checked",_isChecked);
    });

});

/*
 none interpretation folding effect
 */
function toggleDetail(source, target) {
    var caret = $(source).find('i');
    if (caret.attr('class') == 'fa fa-sort-desc') {
        caret.attr('class', 'fa fa-sort-up');
    } else {
        caret.attr('class', 'fa fa-sort-desc');
    }
    $(target).slideToggle();
}
/**
 *
 * @returns {undefined}
 * 回调函数刷新
 */
function call(location){
    if(location != undefined){
        window.location.href = location;
    }else{
        window.location.reload();
    }
}
function updata(url, type, reject,location) {
    if (reject == '0') {
        reject = $('#tbt_return_content').val();
    }
    $.getJSON(url, {
        'id': $('#tbt_product_id').val(),
        'type': type,
        'reject': reject
    }, function (ret) {
        if(ret == '0'){
            $('#dialog-confirm').confirm({contentString:'操作失败！',titleString:'操作结果',submitString:'确定',callback:'call()'});
        }else if(ret == '1'){
            if(location != undefined){
                $('#dialog-confirm').confirm({contentString:'操作成功！',titleString:'操作结果',submitString:'确定',callback:'call("'+location+'")'});
                return false;
            }
            $('#dialog-confirm').confirm({contentString:'操作成功！',titleString:'操作结果',submitString:'确定',callback:'call()'});
            return false;
        }else if(ret == '11'){
            $('#dialog-confirm').confirm({contentString:'操作成功！',titleString:'操作结果',submitString:'确定'});
            return false;
        } else if(ret.status == '10000'){
            if(location != undefined){
                $('#dialog-confirm').confirm({contentString:'操作成功！',titleString:'操作结果',submitString:'确定',callback:'call("'+location+'")'});
                return false;
            }else if(ret.url !=undefined && ret.url.length>0){
                $('#dialog-confirm').confirm({contentString:'操作成功！',titleString:'操作结果',submitString:'确定',callback:'call("'+ret.url+'")'});
                return false;
            }
            $('#dialog-confirm').confirm({contentString:'操作成功！',titleString:'操作结果',submitString:'确定',callback:'call()'});
            return false;
        }else if(ret.status != '10000'){
            if(location != undefined){
                $('#dialog-confirm').confirm({contentString:ret.message,titleString:'操作结果',submitString:'确定',callback:'call("'+location+'")'});
                return false;
            }
            $('#dialog-confirm').confirm({contentString:ret.message,titleString:'操作结果',submitString:'确定',callback:'call()'});
            return false;
        }
    });
}

function formSubmit(obj){
    obj.submit();
}

/**
 * 起止日期输入校验
 */
function dateFocusChecked(){
    $(".fromEnddate .errorMessage").html("");
};

function dateBlurChecked(){
    var $beginDate = parseInt($(".beginDate").val());
    var $endDate = parseInt($(".endDate").val());
    if($beginDate > $endDate){
        $(".fromEnddate .errorMessage").html("您输入的起始日期大于结束日期！");
    }else{
        $(".fromEnddate .errorMessage").html("");
    }
};

function sizeLayout() {
    var headerH = $("#tbtHead").outerHeight();
    var footerH = $("#tbtFooter").outerHeight();
    var winH = $(window).height();
    var minH = winH - headerH - footerH - 20;
    if(ie6=!-[1,]&&!window.XMLHttpRequest){
        $("#tbtLeft,#tbtMain").css({'min-height': minH ,'height':'auto !important;', 'height': minH});
    }else {
        $("#tbtLeft,#tbtMain").css({'min-height': minH ,'height':'auto !important;', '_height': minH});
    };
}



