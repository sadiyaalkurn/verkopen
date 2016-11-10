<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class BootstrapDialogAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap3-dialog/dist';
    
    public $css = [
        'css/bootstrap-dialog.min.css',
    ];
    public $js = [
        'js/bootstrap-dialog.min.js',
    ];
    
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}
