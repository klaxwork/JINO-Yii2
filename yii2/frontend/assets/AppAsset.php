<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    //public $sourcePath = '@app/themes/site1';
    public $basePath = '@webroot/themes/site1';
    public $baseUrl = '@web/themes/site1';
    public $css = [
        'css/cssx.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
