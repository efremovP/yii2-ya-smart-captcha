## Yandex Smart Captcha integration for Yii2

Installation
------------

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist efremovp/yii2-ya-smart-captcha "*"
```

or add

```json
"efremovp/yii2-ya-smart-captcha": "*"
```

to the require section of your composer.json.


Configuration
-------------

To use this extension, you have to configure the Connection class in your application configuration (params-local.php):

```php
return [
    //....
    'ya_captcha' => [
        'error_message' => 'Подтвердите, что вы не бот.',
        'client_key' => '******',
        'server_key' => '******'
    ],
];
```

### How to get keys
https://yandex.cloud/ru/docs/smartcaptcha/quickstart


## Basic Usage

Add widget to views
```
<?= \efremovP\YaCaptcha\YaCaptchaWidget::widget(['form' => $form, 'model' => $model]) ?>
```

Add rules and yaCaptcha field to form model
```
<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $yaCaptcha; // add captcha field


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // add captcha rules
            ['yaCaptcha', 'required', 'message' => Yii::$app->params['ya_captcha']['error_message']],
            ['yaCaptcha', \efremovP\YaCaptcha\validators\YaCaptchaValidator::class],
        ];
    }
```

## Additional Functionality

### Add callback function
```
<?= \efremovP\YaCaptcha\YaCaptchaWidget::widget(['form' => $form, 'model' => $model, 'successCallback' => 'successCaptchaCallback']) ?>


<script>
    function successCaptchaCallback() {
        console.log('captcha is success');
    };
</script>

```

### Add language, (default ru)
```
<?= \efremovP\YaCaptcha\YaCaptchaWidget::widget(['form' => $form, 'model' => $model, 'lang' => 'en']) ?>

```
