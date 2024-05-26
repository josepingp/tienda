<?php

function dinamycCaptchaText($chars, $long)
{
    $string = '';

    for ($i = 0; $i < $long; $i++) {
        $string = $string . substr($chars, rand(0, strlen($chars) -1), 1);
    }

    return $string;
}

