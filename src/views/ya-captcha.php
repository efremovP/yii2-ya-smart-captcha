<?php
$this->registerJsFile('https://smartcaptcha.yandexcloud.net/captcha.js?render=onload&onload=smartCaptchaInit', ['async' => true, 'defer' => true]);
?>

<?= $form->field($model, $fieldName, ['template' => "<div class=\"error\">{error}</div>\n{input}"])->hiddenInput()->label('') ?>
<div id="captcha-container_<?= $nameForm ?>"></div>

<script>
	function smartCaptchaInit() {
		if (!window.smartCaptcha) {
			return;
		}

		const container = document.getElementById('captcha-container_<?= $nameForm ?>');

		const widgetId_<?= $nameForm ?> = window.smartCaptcha.render(container, {
			sitekey: '<?= $clientKey ?>',
			hl: '<?= $lang ?>',
			callback: yandex_captcha_<?= $nameForm ?>,
		});

		<?php if ($successCallback): ?>

			const unsubscribe = window.smartCaptcha.subscribe(
				widgetId_<?= $nameForm ?>,
				'success',
				() => <?= $successCallback ?>()
			);

		<?php endif; ?>


	}

	function yandex_captcha_<?= $nameForm ?>() {
		var smartToken = document.querySelector('#captcha-container_<?= $nameForm ?> > input[name="smart-token"]').value;
		document.getElementById('<?= $inputId ?>').value = smartToken;
	}
</script>
