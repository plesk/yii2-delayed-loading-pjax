<?php
// Copyright 1999-2017. Plesk International GmbH. All rights reserved.

namespace plesk\delayedloadingpjax;

use yii\web\AssetBundle as YiiAssetBundle;


class AssetBundle extends YiiAssetBundle
{
    public $sourcePath = '@vendor/plesk/yii2-delayed-loading-pjax/assets';
    public $css = [
        'delayed-loading-pjax.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\widgets\PjaxAsset',
    ];
}
