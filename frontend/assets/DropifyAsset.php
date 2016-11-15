<?php
namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class DropifyAsset extends AssetBundle
{
    public $sourcePath = '@bower/dropify/dist';

    public $css = [
        'css/dropify.css',
    ];
    public $js = [
        'js/dropify.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}