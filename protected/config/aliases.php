<?php

Yii::setAlias('@webroot', dirname(__DIR__, 2));
Yii::setAlias('@web', '/');

return [
    '@bower' => '@vendor/bower-asset',
    '@npm' => '@vendor/npm-asset',
    '@tests' => '@app/tests',
    '@backups' => '@app/backups',
    '@upload_path' => '@webroot/upload',
    '@upload_web' => '@web/upload',
];
