<?php

/**
 * 公共类
 */
class My {

    /**
     * json 输出
     * @param type $data
     * @param type $status
     * @param type $message
     */
    static function output($data, $status = 10000, $message = "") {
        header("Content-type: application/json");
        $arr = array('status' => $status, 'data' => $data, 'message' => $message);
        Yii::log('返回结果: ' . json_encode($arr, JSON_UNESCAPED_UNICODE), CLogger::LEVEL_PROFILE, 'newapi');
        echo json_encode($arr);
        exit;
    }

    /**
     * json转数组
     * @param type $obj json
     * @return array 数组
     */
    static function my_json_encode($obj) {
        return json_encode($obj, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 数组转json
     * @param type $json 数组
     * @param type $assoc 标识
     * @return type json
     */
    static function my_json_decode($json, $assoc = TRUE) {
        $json = str_replace(array("\r\n", "\n"), "\\n", $json);
        return json_decode($json, $assoc);
    }

    /**
     * 获取金额
     * @param type $moneyString 金额
     * @return type 金额
     */
    static function getCompare($moneyString) {

        foreach (MoneyCompare::items() as $compare) {

            if (strstr($moneyString, $compare) !== false) {
                $moneyArray = explode($compare, $moneyString);
                $money = isset($moneyArray[1]) ? (double) $moneyArray[1] * 10000 : 0;
                return array($compare, $money);
            }
        }
        return array('=', (double) $moneyString * 10000);
    }

    /**
     * 验证上传文件
     * @param type $file 文件
     * @param type $fileName 新的文件名
     * @param type $size 图片大小
     * @return null|string 状态码
     */
    static function uploadImage($file, $fileName, $size = 0, $tip = 0) {
        if ($file == null) {
            return null;
        }
        $typeArray = explode('/', $file->getType());
        $extensionName = $file->getExtensionName(); //验证文件后缀名并声明允许的img后缀类型 By wmx
        $imagesExtensionName = array('gif', 'jpg', 'png', 'jpeg');
        if (!isset($typeArray[0])) {
            return null;
        }
        if ($typeArray[0] != 'image') {
            return '-1';
        }
        if (empty($extensionName) || !in_array($extensionName, $imagesExtensionName)) {
            return '-1';
        }
        if ($size > 0 && $file->getSize() > $size) {
            return '-2';
        }
        if (!isset($typeArray[0])) {
            return null;
        }
        return self::upload($file, $fileName, $tip);
    }

    /**
     * 上传
     * @param type $file 文件
     * @param string $fileName 新的文件名
     * @return null 文件名
     */
    static function upload($file, $fileName, $tip) {
        if ($file == null) {
            return null;
        }
        $nameTypeArray = explode('.', $file->getName());
        $nameType = end($nameTypeArray);
        $uploadDir = './upload/' . $fileName . '/' . date('Y-m');
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        if ($tip == 0) {
            $fileName = $uploadDir . '/' . time() . '.' . $nameType;
        } else {
            $fileName = $uploadDir . '/' . time() . rand(100, 999) . '.' . $nameType;
        }
        $file->saveAs($fileName, true);
        return trim($fileName, '.');
    }

    /**
     * 格式化时间
     * @param type $date 时间
     * @return string 时间
     */
    static function formatDate($date, $type = 'Y-m-d') {
        if ($date <= 0) {
            return $date;
        }
        if (strtotime($date) == false) {
            return $date;
        }

        if (strtotime($date) < 1) {
            return substr($date, 0, 10);
        }

        return date($type, strtotime($date));
    }

    /**
     * 计算两个字符串时间相隔天数
     * 
     */
    static function calcDays($start, $end) {
        if (strtotime($start) == FALSE || strtotime($end) == FALSE) {
            return 0;
        } else {
            return (strtotime($end) - strtotime($start)) / (60 * 60 * 24);
        }
    }

    /**
     * By wmx
     * @param type $data content
     * @return string content
     */
    static function htmlDecode($data) {
        return $data;
//return htmlspecialchars_decode($data);//解决frontapi的htmlspecialchars 与 百度编辑器自身的 htmlspecialchars 冲突
    }

    /**
     * 获取ID
     * @param type $type ID 类型
     * @param type $resourceType 创建的类型
     * @return null ID
     */
    static function getCreateId($type, $resourceType = 0) {
        $model = Seed::model()->find('type=:type AND resource_type=:resource_type', array(':type' => $type, ':resource_type' => $resourceType));
        $number = '';
        if (CreateIdType::$product == $type) {
            if ($model == null) {
                $number = '1' . $resourceType . '001';
            }
        } elseif (CreateIdType::$organization == $type) {
            if ($model == null) {
                $number = $resourceType . '01';
            }
        } elseif (CreateIdType::$order == $type) {
            if ($number == null) {
                $number = '600001';
            }
        } elseif (CreateIdType::$appointment == $type) {
            if ($number == null) {
                $number = '100001';
            }
        } elseif (CreateIdType::$tycoonAppointment == $type) {
            if ($number == null) {
                $number = '100001';
            }
        } else {
            return null;
        }
        if ($model != null) {
            $number = $model->number + 1;
        } else {
            $model = new Seed;
        }
        $model->number = $number;
        $range = array(CreateIdType::$appointment, CreateIdType::$tycoonAppointment, CreateIdType::$order);
        if (in_array($type, $range)) {
            $number = $number . rand(10, 99);
        }
        $model->resource_type = $resourceType;
        $model->type = $type;
        if ($model->save()) {
            return $model->code . $number;
        }
        return null;
    }

    /**
     * 随机密码
     * @param type $dot 几位
     * @return string 密码
     */
    static function random($dot = 6) {
        $chars = 'qwertyuiopasdfghjklzxcvbnm1234567890';
        $numbers = '1234567890';
        $letter = 'abcdefghigklmnopqrstuvwxyz';
        $password = '';
        for ($i = 0; $i < $dot; $i++) {
            $password .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        if (!preg_match('/^(?=.*[a-zA-Z])(?=.*[\d])[a-zA-Z\d]{1}\w{5,11}$/', $password)) {
            $password = substr_replace($password, $letter[mt_rand(0, strlen($letter) - 1)], 0, 1);
            $password = substr_replace($password, $numbers[mt_rand(0, strlen($numbers) - 1)], -2, -1);
        }
        return $password;
    }

    /**
     * 访问FrontApi
     * @param string $url url
     * @param type $data 数据
     * @return type 结果
     */
    static function API($uri, $data) {

        $encryptType = ucfirst(Yii::app()->params['site']['encrypt_type']);
        $encryptServer = new $encryptType(Yii::app()->params['site']['iv']);

        $data['encrypt'] = true;
        $data['web'] = 'web';

        $data = self::getData($data);
        $item = array();
        $item['org_id'] = Yii::app()->params['site']['org_id'];
        $item['sign'] = '';
        $item['params'] = $data;
        $ch = curl_init();
        $query = self::getParams($item);
        $data = $encryptServer->encrypt(Yii::app()->params['site']['key'], $query);
        if (!is_array($data)) {
            $item['params'] = $data;
        } else {
            $item['params'] = $data['params'];
            $item['sign'] = $data['sign'];
        }
        $ssl = substr($uri, 0, 8) == "https://" ? true : false;
        if ($ssl) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, value)
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        if (!empty(Yii::app()->params['site']['local'])) {
            $host = "f.t.local";
            curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1" . '/' . trim($uri, '/'));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: ' . $host));
        } else {
            curl_setopt($ch, CURLOPT_URL, trim(Yii::app()->params['online']['apiUrl'], '/') . '/' . trim($uri, '/'));
        }
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $item);
        $ret = curl_exec($ch);
//print_r($ret);
        Yii::log(json_encode($ret, JSON_UNESCAPED_UNICODE), 'info', 'info');
        if (isset($_GET['res']) == $uri && YII_DEBUG) {
            print_r($ret);
            exit;
        }
        return self::my_json_decode($ret);
    }

    /**
     * CHtmlPurifier过滤特殊字符
     * @author  wangmingxu
     */
    static function ChtmlPurify($data) {
        return $data;
//        $p = new CHtmlPurifier();
//        return $p->purify($data);
    }

    /**
     * api调用过滤多余数据
     * @param type $data 原始数据
     * @return type 过滤后的数据
     */
    static function getData($data) {
        $item = array();
        if (isset($data['reject'])) {
            $data['reject'] = empty($data['reject']) ? 'null' : $data['reject'];
        }
        foreach ($data as $key => $val) {
            if (!is_array($val)) {
                $item[$key] = self::ChtmlPurify($val);
            }
        }
        return $item;
    }

    /**
     * api调用生成url数据
     * @param type $item 数据
     * @return type url数据
     */
    static function getParams($item) {
        $str = '';
        $comma = '';
        foreach ($item['params'] as $key => $val) {
            $str .= $comma;
            $comma = "&";
            $str .= urlencode($key);
            $str .= "=";
            $str .= urlencode($val);
        }

        return $str;
    }

    /**
     * 生成密钥串
     * @param type $data 数据
     * @return type 密钥串
     */
    static function sign($data) {
        $str = '';
        $comma = '';
        foreach ($data as $key => $val) {
            $str .= $comma;
            $comma = "&";
            $str .= urlencode("params[" . $key . "]");
            $str .= "=";
            $str .= urlencode($val);
        }
        return md5(Yii::app()->params['site']['key'] . $str);
    }

    /**
     * 验证验证码
     */
    static public function checkCode($code) {
        $sms = new ShortMessageService();
        if ($code == $sms->checkRegisterCode() || (defined('YII_DEBUG') && YII_DEBUG && $code == '5555')) {
            return ApiStatusCode::$ok;
        }
        return ApiStatusCode::$error;
    }

    /*     * *
     * 对比token
     * wangchunyan
     * 2015年12月23日
     */

    static public function checkToken() {
        $session = Yii::app()->session;
        $user_id = Yii::app()->user->id;
        $sessionKey = $user_id . '_is_sending';
        if (!isset($session[$sessionKey])) {
            $session[$sessionKey] = microtime(true);
            return 3;
        }
        if (isset($session[$sessionKey])) {
            $first_submit_time = $session[$sessionKey];
            $current_time = microtime(true);
            Yii::log('my时间戳' . ($current_time - $first_submit_time), 'info', 'info');
            if ($current_time - $first_submit_time < 10 && $current_time != $first_submit_time) {
                $session[$sessionKey] = $current_time;
                return 0;
            } else if ($current_time == $first_submit_time) {
                return 0;
            } else if ($current_time - $first_submit_time >= 10) {
                unset($session[$sessionKey]);
                return 2;
            }
        }
    }

    /**
     * 将数组中的其中一个值提取出来 组成一个新的数组
     * @param type $data
     * @param type $key
     * @return type
     */
    static function arrayValueMap($data, $key) {
        if (empty($data) || empty($key)) {
            return $data;
        }
        $ret = array();
        foreach ($data as $item) {
            $ret[] = $item[$key];
        }

        return $ret;
    }

    /**
     * 排序函数
     */
    static function sortinfo($multi_array, $sort_key, $sort = SORT_DESC) {
        if (is_array($multi_array)) {
            foreach ($multi_array as $row_array) {
                if (is_array($row_array)) {
                    $key_array[] = $row_array[$sort_key];
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
        array_multisort($key_array, $sort, $multi_array);
        return $multi_array;
    }

    /**
     * pdf文件夹打包下载
     * @param type $path pdf文件存放的位置
     * @param type $zip 
     */
    static function addFileToZip($path, $zip) {
        $handler = opendir($path); //打开当前文件夹由$path指定。
        while (($filename = readdir($handler)) !== false) {
            if ($filename != "." && $filename != "..") {//文件夹文件名字为'.'和‘..’，不要对他们进行操作
                if (is_dir($path . "/" . $filename)) {// 如果读取的某个对象是文件夹，则递归
                    addFileToZip($path . "/" . $filename, $zip);
                } else { //将文件加入zip对象
                    $zip->addFile($path . "/" . $filename);
                }
            }
        }
        @closedir($path);
    }

    /**
     * 删除非空pdf存放目录
     * @param type $path
     * @return boolean
     */
    static function removeDir($dirName) {
        if (!is_dir($dirName)) {
            return false;
        }
        $handle = @opendir($dirName);
        while (($file = @readdir($handle)) !== false) {
            if ($file != '.' && $file != '..') {
                $dir = $dirName . '/' . $file;
                is_dir($dir) ? removeDir($dir) : @unlink($dir);
            }
        }
        closedir($handle);
        return rmdir($dirName);
    }

    /*     * *
     * 获取产品列表
     * wangchunyan
     * 2016年01月21日
     */

    static function getProductList($status, $type = '0', $typeMark = 0) {
        $proxyId = Yii::app()->user->getState('organization_id');
        $ret = My::API('/sell/product/lstProducts', array('institutionid' => $proxyId, 'status' => $status, 'page_size' => 999, 'type' => $type, 'typeMark' => $typeMark));
        $data = array();
        if (!empty($ret['data']['products'])) {
            foreach ($ret['data']['products'] as $k => $v) {
                $data[$v['id']] = $v['id'] . '--' . $v['nameAbbr'];
            }
        }
        return $data;
    }

    static function getProductList1($typeMark) {
        $ret = My::API('/tong/product/institution_getallproduct', array('page_size' => 999, 'typeMark' => $typeMark));
        $data = array();
        if (!empty($ret['data']['products'])) {
            foreach ($ret['data']['products'] as $k => $v) {
                $data[$v['id']] = $v['id'] . '--' . $v['nameAbbr'];
            }
        }
        return $data;
    }

    /**
     * 千分位格式化
     */
    static function numberFormat($amount) {
        return number_format($amount, 2);
    }

    /**
     * 获取model的第一个错误
     * @param type $errors
     * @return type
     */
    static function getModelErrors($errors) {
        $error = current($errors);
        return $error[0];
    }
    
    /**
     * upload文件增加域名
     * @param type $path
     * @return type
     */
    static function uploadUrlAdd($path) {
        if (!is_array($path)) {
            if (!empty($path) && stripos($path, 'http://') === FALSE && stripos($path, 'https://') === FALSE) {
                return Yii::app()->params['site']['uploadUrl'] . $path;
            } else {
                return $path;
            }
        } else {
            foreach ($path as &$item) {
                $item = self::uploadUrlAdd($item);
            }
            return $path;
        }
    }

}
