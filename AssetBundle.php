<?php
// Copyright 2017-2020 Plesk International GmbH

namespace plesk\delayedloadingpjax;

use yii\web\AssetBundle as YiiAssetBundle;
use yii\web\JqueryAsset;
use yii\bootstrap4\BootstrapAsset;
use yii\widgets\PjaxAsset;

class AssetBundle extends YiiAssetBundle
{
    public $sourcePath = '@vendor/plesk/yii2-delayed-loading-pjax/assets';
    public $css = [
        'delayed-loading-pjax.css',
    ];
    public $depends = [
        JqueryAsset::class,
        BootstrapAsset::class,
        PjaxAsset::class,
    ];
}
