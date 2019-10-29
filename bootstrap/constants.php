<?php
/**
 * Created by PhpStorm.
 * User: Other
 * Date: 2019/8/29
 * Time: 10:03
 */
//code定义
define("CODE_SUCCESS",100); //请求成功
define("CODE_FAIL",99); //请求成功



//栏目开启关闭
define("COLUMN_STATE_START",1);
define("COLUMN_STATE_STOP",2);

define("CATEGORY_ARTICLE_ID",1);
define("CATEGORY_IMG_ID",2);
define("CATEGORY_GOODS_ID",3);
define("CATEGORY_VIDEO_ID",4);
define("CATEGORY_SPECIAL_ID",5);
define("CATEGORY_LINK_ID",6);

define(
    "CATEGORY_IDS" ,
    [
        CATEGORY_ARTICLE_ID,
        CATEGORY_IMG_ID,
        CATEGORY_GOODS_ID,
        CATEGORY_VIDEO_ID,
        CATEGORY_SPECIAL_ID,
        CATEGORY_LINK_ID
    ]
);

//栏目类型
define("COLUMN_CATEGORY",[
    ['id'=>CATEGORY_ARTICLE_ID ,'name'=>'文章'],
    ['id'=>CATEGORY_IMG_ID ,'name'=>'图片'],
    ['id'=>CATEGORY_GOODS_ID ,'name'=>'商品'],
    ['id'=>CATEGORY_VIDEO_ID ,'name'=>'视频'],
    ['id'=>CATEGORY_SPECIAL_ID ,'name'=>'专题'],
    ['id'=>CATEGORY_LINK_ID ,'name'=>'链接']
]);

//栏目模板类型
//首页
define("COL_TEMPLATES_INDEX" , 1);
//列表页
define("COL_TEMPLATES_LIST" , 2);
//详情页
define("COL_TEMPLATES_SHOW" , 3);


//
//栏目开启关闭
define("TEMPLATE_START",1);
define("TEMPLATE_STOP",2);