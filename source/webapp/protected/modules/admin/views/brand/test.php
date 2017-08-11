<html>
    <head>
        <title>title</title>

<!--        <link rel="stylesheet" type="text/css" href="/resource/dhtmlxCalendar_v421_std/codebase/dhtmlxcalendar.css?2014082614" />
        <link rel="stylesheet" type="text/css" href="/resource/js/jquery-ui-1.9.2.custom/css/smoothness/jquery-ui-1.9.2.custom.css?2014082614" />
        <link rel="stylesheet" type="text/css" href="/resource/css/reset.css?2014082614" />
        <link rel="stylesheet" type="text/css" href="/resource/css/style.css?2014082614" />
        <link rel="stylesheet" type="text/css" href="/resource/css/printstyle.css?2014082614" />
        <link rel="stylesheet" type="text/css" href="/resource/css/stylesheet.css?2014082614" />-->
        <script type="text/javascript" src="/resource/js/jquery.min.js?2014082614"></script>
        
        
        
        <!--<script type="text/javascript" src="/resource/js/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.js?2014082614"></script>-->
        <!--<script type="text/javascript" src="/resource/dhtmlxCalendar_v421_std/codebase/dhtmlxcalendar.js?2014082614"></script>-->
<!--        <script type="text/javascript" src="/resource/js/tbt.js?2014082614"></script>
        <script type="text/javascript" src="/resource/js/jquery.yiiactiveform.js?2014082614"></script>
        <script type="text/javascript" src="/resource/js/jquery.yii.js?2014082614"></script>-->
        <script type="text/javascript" src="/resource/js/ajaxupload.js?2014082614"></script>
    </head>
    <body>
        <?php echo CHtml::Button('上传', array('class' => 'btn btn-primary btn-file activeFileSubmit')); ?>
        <script>
            $(function () {
                $(".activeFileSubmit").each(function () {
                    uploadBtn = $(this);
                    new AjaxUpload(uploadBtn, {
                        action: "/tong/default/UploadPmetalImage/FormIframeUpload[field]/",
                        name: "FormIframeUpload[fileField]",
                        data: {YII_CSRF_TOKEN: "<?php echo Yii::app()->request->csrfToken; ?>"},
                        onComplete: function (file, response) {
                            uploadBtn.disabled = "";
                            uploadBtn.value = "上传";
                        }
                    });
                });
            })
        </script>
    </body>
</html>
