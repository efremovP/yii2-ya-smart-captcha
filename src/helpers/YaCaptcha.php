<?php
namespace efremovP\YaCaptcha\helpers;

use Yii;

/**
 *
 * Yandex captcha
 *
 * @author Ефремов Петр
 * @since 2.0
 */
class YaCaptcha
{
    const YANDEX_CAPTCHA_URL = 'https://smartcaptcha.yandexcloud.net/validate';
    /**
     * @param string $tokent
     * @return int|null
     */
    public static function check($token)
    {
        $clientIp = $_SERVER['HTTP_X_REAL_IP']?? $_SERVER['REMOTE_ADDR'];

        $ch = curl_init(self::YANDEX_CAPTCHA_URL);
        $args = [
            "secret" => Yii::$app->params['ya_captcha']['server_key'],
            "token" => $token,
            "ip" => $clientIp, // Нужно передать IP-адрес пользователя.
        ];
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode !== 200) {
            echo "Allow access due to an error: code=$httpcode; message=$server_output\n";
            return true;
        }

        $resp = json_decode($server_output);

        return $resp->status === "ok";
    }

}