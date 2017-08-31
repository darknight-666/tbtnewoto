<?php

/**
 * 定时任务
 */
class TimedTaskController extends Controller {

    /**
     * 每日执行 00:01分
     */
    public function actionDaily() {
        echo SystemConfig::systemWeek();die;
        // step1 系统日期同步
        SystemConfig::systemDateFlush();
        
        // step 2 过期代金券退款申请
        
        echo 'success';
    }
    
}
