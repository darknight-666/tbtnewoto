<?php

class ShortMessageService {

    const ERROR_NONE = 0;
    const ERROR_CODE_INVALID = 2001;
    const ERROR_CODE_TIMEOUT = 2002;

    public $sessionTimeOut = 180; // 验证码超时时间X秒
    public $sessionCodeName;
    public $content;
    public $code;
    public $errorCode;

    /**
     * 通用短信发送
     * @param type $phones
     * @param type $content
     * @return type
     */
    public function send($phones, $content) {
        $ret = array();
        $this->content = $content;
        if (is_array($phones)) {
            foreach ($phones as $phone) {
                $ret[$phone] = $this->sendHandler($phone, $content);
            }
        } else {
            $ret[$phones] = $this->sendHandler($phones, $content);
        }
        return $ret;
    }

    /**
     * 短信发送控制器
     * @param type $phone
     * @param type $content
     * @return type
     */
    private function sendHandler($phone) {
        if (isset(Yii::app()->params['sms']['environment']) && Yii::app()->params['sms']['environment'] === true) { // true 开启测试
            $phone = Yii::app()->params['sms']['phonenumberTest']; // 测试专用接收手机电话号码
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, Yii::app()->params['sms']['url']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getPost($phone));
        $ret = curl_exec($ch);
        curl_close($ch);
        return $ret;
    }

    /**
     * 短信发送 - http 信息拼接
     * @param  [type] $phone [接受的手机号]
     */
    public function getPost($phone) {
        $data = urlencode($this->content . Yii::app()->params['sms']['signature']);
        $postArr = array(
            'account' => Yii::app()->params['sms']['user'],
            'pswd' => Yii::app()->params['sms']['password'],
            'msg' => $data,
            'mobile' => $phone,
            'needstatus' => 'true',
        );
        return http_build_query($postArr);
    }

    /**
     * 发送验证码
     * @param type $phone
     * @param type $type
     * @return type
     */
    public function sendMessageCode($phone, $type) {
        $code = rand(1000, 9999);
        $this->code = $code;
        $this->saveMessageCodeToSession($phone, $type, $code);
        return $this->send($phone, '手机验证码是' . $code . '，请尽快输入以继续完成操作。为了您的账户安全，请勿泄露、转发或告知他人。');
    }

    /**
     * code存入session
     * @param type $phone
     * @param type $type
     * @param type $code
     */
    public function saveMessageCodeToSession($phone, $type, $code) {
        $this->sessionCodeName = MessageCodeType::getSessionTitle($type);
        Yii::app()->session[$this->sessionCodeName] = array(
            'code' => $code,
            'timeout' => time() + $this->sessionTimeOut,
            'phonenumber' => $phone
        );
    }

    /**
     * 获取session中的code
     * @param type $type
     */
    public function getMessageCodeInSession($type) {
        return Yii::app()->session[MessageCodeType::getSessionTitle($type)];
    }

    /**
     * 校检session中的code
     * @param type $phonenumber
     * @param type $code
     * @param type $type
     * @return type
     */
    public function checkMessageCode($phonenumber, $code, $type, $checkTimeOut = TRUE) {
        $sessionCode = $this->getMessageCodeInSession($type);
        $this->errorCode = self::ERROR_NONE;
        if (empty($sessionCode)) {
            $this->errorCode = self::ERROR_CODE_INVALID;
        } else {
            if ($sessionCode['phonenumber'] != $phonenumber) {
                $this->errorCode = self::ERROR_CODE_INVALID;
            }
            if ($sessionCode['code'] != $code) {
                if (YII_TBTENV == 1) { // 生产环境
                    $this->errorCode = self::ERROR_CODE_INVALID;
                } else if ($code != '5555') {
                    $this->errorCode = self::ERROR_CODE_INVALID;
                }
            }
            if ($sessionCode['timeout'] < time() && $checkTimeOut == TRUE) {
                $this->errorCode = self::ERROR_CODE_TIMEOUT;
            }
        }
        return $this->errorCode;
    }

}
