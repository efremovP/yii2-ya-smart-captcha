<?php

namespace efremovP\YaCaptcha\validators;

use Yii;
use yii\validators\Validator;
use efremovP\YaCaptcha\helpers\YaCaptcha;

class YaCaptchaValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if (! YaCaptcha::check($model->$attribute)) {
            $this->addError($model, $attribute, Yii::$app->params['ya_captcha']['error_message']);
        }
    }
}