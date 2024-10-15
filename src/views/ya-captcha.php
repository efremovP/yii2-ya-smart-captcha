<?= $form->field($model, $fieldName, ['template' => "<div class=\"error\">{error}</div>\n{input}"])->hiddenInput()->label('') ?>
<div
    id="captcha-container_<?= $nameForm ?>"
    class="smart-captcha"
    data-sitekey="<?= $clientKey ?>"
    data-callback="yandex_captcha_<?= $nameForm ?>"
></div>
<script>
    function yandex_captcha_<?= $nameForm ?>() {
        var smartToken = document.querySelector('#captcha-container_<?= $nameForm ?> > input[name="smart-token"]').value;
        document.getElementById('<?= $inputId ?>').value = smartToken;
    }
</script>
