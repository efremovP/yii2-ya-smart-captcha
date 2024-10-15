<?php
namespace efremovP\YaCaptcha;

use Yii;
use yii\base\Widget;

class YaCaptchaWidget extends Widget
{
    public $form;
    public $model;
    public $fieldName = 'yaCaptcha';

    public function run()
    {
        $parts = explode('\\', get_class($this->model));
        $formName = strtolower(end($parts));

        $clientKey = Yii::$app->params['ya_captcha']['client_key'];

        $inputId = $formName . '-' . strtolower($this->fieldName);

        return $this->render('ya-captcha', [
            'clientKey' => $clientKey,
            'form' => $this->form,
            'model' => $this->model,
            'nameForm' => $formName,
            'fieldName' => $this->fieldName,
            'inputId' => $inputId,
        ]);
    }
}