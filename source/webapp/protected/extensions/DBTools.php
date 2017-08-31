<?php

/**
 * 数据库工具类
 */
class DBTools {

    /**
     * 根据sql语句获取列表
     * @param type $sql
     * @return array array('totalCount'=>1,array(array()));
     */
    static function queryAll($sql, $page = 1, $page_size = 10) {
        $limitSql = "LIMIT " . ($page_size * ($page - 1)) . ',' . $page_size . ' ';
        $conn = Yii::app()->db;
        $command = $conn->createCommand($sql . $limitSql);
        $dataReader = $command->query();
        $data = array('totalCount' => 0, 'items' => array());
        $data['items'] = $dataReader->readAll();
        foreach ($data['items'] as &$item) {
            $item = self::groupDataByArray($item);
        }
        $data['totalCount'] = self::getCount($sql);
        return $data;
    }

    /**
     * 将查询到得数据分组
     * @param type $item
     * @param type $groupBy
     */
    static function groupDataByArray($item, $groupBy = '__') {
        $tmp = array();
        foreach ($item as $key => $value) {
            $keyTmp = explode($groupBy, $key);
            if (count($keyTmp) >= 2) {
                if (isset($tmp[$keyTmp[0]])) {
                    $tmp[$keyTmp[0]][$keyTmp[1]] = $value;
                } else {
                    $tmp[$keyTmp[0]] = array();
                    $tmp[$keyTmp[0]][$keyTmp[1]] = $value;
                }
            } else {
                $tmp[$key] = $value;
            }
        }
        return $tmp;
    }

    /**
     * 根据sql语句获取数据
     * @param type $sql
     * @return array array('totalCount'=>1,array(array()));
     */
    static function queryOne($sql) {
        $conn = Yii::app()->db;
        $command = $conn->createCommand($sql);
        $command->where;
        $dataReader = $command->query();
        $data = $dataReader->read();
        return $data;
    }

    /**
     * 获取数据总条数
     * @param type $sql
     * @return type
     */
    static function getCount($sql) {
        $conn = Yii::app()->db;
        $command = $conn->createCommand($sql);
        $dataReader = $command->query();
        return $dataReader->count();
    }

}
