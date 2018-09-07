<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
        'css/bootstrap.min.css',
        'css/bootstrap-datetimepicker.min.css',
        'css/font_yjd4l717y51giudi/iconfont.css',
        
    ];
    public $js = [
    	'js/jquery-v2.1.1.min.js',
    	'js/bootstrap.min.js',
    	'js/moment-with-locales.min.js',
    	//'js/moment_zhCN.js',
    	'js/bootstrap-datetimepicker.min.js',
    	'bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/js/bootstrap.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
