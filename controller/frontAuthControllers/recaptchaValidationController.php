<?php

function validateCaptcha($captcha, $secret) {

    $access = false;
        
    $reCaptcha = new ReCaptcha($secret);
    $response = null;

    if (!$captcha) {
        $access = false;
    } else {
        $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $captcha);
        if ($response != null && $response == true) {
            $access = true;
        }
    }

    return $access;
}

?>