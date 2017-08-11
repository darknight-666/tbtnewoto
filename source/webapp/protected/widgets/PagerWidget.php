<?php

class PagerWidget extends CLinkPager {
    // 重写部分父类效果
    const CSS_FIRST_PAGE = 'first';
    const CSS_LAST_PAGE = 'last';
    const CSS_PREVIOUS_PAGE = 'previous';
    const CSS_NEXT_PAGE = 'next';
    const CSS_INTERNAL_PAGE = 'page';
    const CSS_HIDDEN_PAGE = 'hidden';
    const CSS_SELECTED_PAGE = 'selected';
    
    public $firstPageCssClass = self::CSS_FIRST_PAGE;
    public $lastPageCssClass = self::CSS_LAST_PAGE;
    public $previousPageCssClass = self::CSS_PREVIOUS_PAGE;
    public $nextPageCssClass = self::CSS_NEXT_PAGE;
    public $internalPageCssClass = self::CSS_INTERNAL_PAGE;
    public $hiddenPageCssClass = self::CSS_HIDDEN_PAGE;
    public $selectedPageCssClass = self::CSS_SELECTED_PAGE;
    public $maxButtonCount = 10;
    public $nextPageLabel = '下一页';
    public $prevPageLabel = '上一页';
    public $firstPageLabel = '首页';
    public $lastPageLabel = '末页';
    public $header = '';
    public $footer = '';
    public $cssFile;

}
