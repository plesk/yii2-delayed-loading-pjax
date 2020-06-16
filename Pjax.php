<?php
// Copyright 2017-2020 Plesk International GmbH

namespace plesk\delayedloadingpjax;

use Yii;
use yii\widgets\Pjax as YiiPjax;
use yii\helpers\Html;
use yii\helpers\Json;


/**
 * Load content via pjax after opening the page.
 *
 * @see YiiPjax
 * @package plesk\delayedloadingpjax
 */
class Pjax extends YiiPjax
{
    public $hideContentOnPageLoad = false;
    /**
     * @var string
     */
    public $progressClass = 'delayed-loading-pjax-progress';


    public function init()
    {
        Html::addCssClass($this->options, 'delayed-loading-pjax');

        parent::init();
        ?>
            <div class="delayed-loading-pjax-progress-wrapper">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" style="width: 100%">
                        <span>Loading...</span>
                    </div>
                </div>
            </div>
            <div class="delayed-loading-pjax-content-wrapper">
        <?php
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();
        if (!$this->hideContentOnPageLoad ||
            $this->requiresPjax()
        ) {
            echo $content;
        }
        ?>
            </div>
        <?php
        parent::run();
        if (!$this->requiresPjax()) {
            $this->registerAssets();
        }
    }

    public function registerAssets()
    {
        AssetBundle::register($this->view);
    }

    public function registerClientScript()
    {
        parent::registerClientScript();

        $id = $this->options['id'];
        $selector = Json::htmlEncode("#$id");
        $progressClassEncoded = Json::htmlEncode($this->progressClass);

        $this->view->registerJs(
            "jQuery(document).on('pjax:beforeSend', $selector, function (event) {
                var target = jQuery(event.target);
                if (target.attr('id') == " . Json::htmlEncode($id) . ") {
                    jQuery($selector).addClass($progressClassEncoded);
                }
            });"
        );
        $this->view->registerJs(
            "jQuery(document).on('pjax:complete', $selector, function (event) {
                var target = jQuery(event.target);
                if (target.attr('id') == " . Json::htmlEncode($id) . ") {
                    jQuery($selector).removeClass($progressClassEncoded);
                }
            });"
        );

        // prevent the page reload in case error is occurred
        $this->view->registerJs(
            'jQuery(document).on(\'pjax:error\', function(event, xhr, textStatus, error, options) {
                return false;
            });'
        );

        $options = Json::htmlEncode($this->clientOptions);
        $this->view->registerJs(
            'jQuery.pjax.reload(' . $options . ');
                $.pjax.xhr = null;' // allow multiple pjax requests simultaneously
        );
    }
}
