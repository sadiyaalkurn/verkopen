<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 14-Jul-16
 * Time: 4:18 PM
 */

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
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}