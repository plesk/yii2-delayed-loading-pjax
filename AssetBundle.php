<?php
// Copyright 2017-2020 Plesk International GmbH

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
