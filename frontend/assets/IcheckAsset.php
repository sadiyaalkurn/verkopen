<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 14-Jul-16
 * Time: 4:18 PM
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class IcheckAsset extends AssetBundle
{
    public $sourcePath = '@bower/icheck';

    public $css = [
        'skins/all.css',
    ];
    public $js = [
        'icheck.min.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        
    ];
}