<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class StepsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/jquery.steps.css',
    ];
    public $js = [
        'lib/jquery-1.9.1.min.js',
        'lib/jquery.steps.js',
        'lib/jquery.validate.min.js',
        'lib/formsteps.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
