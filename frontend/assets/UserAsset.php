<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class UserAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootsnav.css',
        'css/custom.min.css',
    ];
    public $js = [
        'js/bootsnav.js',
        'js/wow.min.js',
        'js/bootstrap.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}