<?php
namespace efremovP\YaCaptcha;

use Yii;
use yii\base\Widget;

class YaCaptchaWidget extends Widget
{
    public $form;
    public $model;
    public $fieldName = 'yaCaptcha';
    public $successCallback = null;
    public $lang = 'ru';

    private $formName;
    private $clientKey;
    private $inputId;

    public function init()
    {
        $this->clientKey = Yii::$app->params['ya_captcha']['client_key'];

        $parts = explode('\\', get_class($this->model));
        $this->formName = strtolower(end($parts));

        $this->inputId = $this->formName . '-' . strtolower($this->fieldName);
    }

    public function run()
    {
        return $this->render('ya-captcha', [
            'clientKey' => $this->clientKey,
            'form' => $this->form,
            'model' => $this->model,
            'nameForm' => $this->formName,
            'fieldName' => $this->fieldName,
            'inputId' => $this->inputId,
            'successCallback' => $this->successCallback,
            'lang' => $this->lang,
        ]);
    }
}