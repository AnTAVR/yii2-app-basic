<?php

use app\themes\BasicTheme;
use kartik\icons\Icon;

$domen = 'localhost.localhost';

return [
    'brandLabel' => 'brandLabel',
    'brandLabelText' => 'brandLabelText',
    'language' => 'ru-RU',
    'theme' => BasicTheme::class,
    'appName' => $domen,
    'adminEmail' => 'info@' . $domen,
    'supportEmail' => 'robot@' . $domen,
    'senderEmail' => 'noreply@' . $domen,
    'senderName' => $domen . ' mailer',
    'icon-framework' => Icon::FA,
    'bsVersion' => 4,
    'string.max' => 255,
    'contact.body.max' => 3000,
    'email.max' => 128,
    'phone.countries' => ['ru', 'ua'],
];
