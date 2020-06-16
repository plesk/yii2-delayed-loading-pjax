Plesk extension for Yii2 framework to load content via pjax after opening the page
============================

This extension uses `yiisoft/yii2-bootstrap4`.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

- Add the following lines to your `composer.json` file:

    ```js
    "repositories": [
        {
            "type": "vcs",
            "url":  "git@github.com:plesk/yii2-delayed-loading-pjax.git"
        }
    ]
    ```

- Run `composer require "plesk/yii2-delayed-loading-pjax:^2.0.0"`

API
------------

```php
use plesk\delayedloadingpjax\Pjax;

// See yii\widgets\Pjax
```

To handle pjax errors you should setup your handler before calling this widget.
```html
<head>
    <?php
        $this->registerJs(
            '$(document).on(\'pjax:error\', function(event, xhr, textStatus, error, options) {
                pleskMessageBox.options.title = error;
                pleskMessageBox.alert(xhr.responseText);
            });'
        );
    ?>
</head>

```

Exceptions

    - plesk\delayedloadingpjax\exceptions\Exception

        All exceptions thrown by the extension, extend this exception.