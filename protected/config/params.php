<?php

use kartik\icons\Icon;

$domen = 'localhost.localhost';

return [
    'language' => 'ru-RU',
    'appName' => $domen,
    'adminEmail' => 'info@' . $domen,
    'senderEmail' => 'noreply@' . $domen,
    'senderName' => $domen . ' mailer',
    'icon-framework' => Icon::FA,
    'bsVersion' => 4,
];
