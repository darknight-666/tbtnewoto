<?php

abstract class BaseMoudle extends CWebModule {

    public $menus = array();
    public $params = array('title' => '', 'title_img' => '', 'icon' => '');
    public $tableIcon = true;
    public $tableMenu = array('search' => false, 'colVis' => false, 'copy' => false, 'print' => false, 'export' => false);

}
