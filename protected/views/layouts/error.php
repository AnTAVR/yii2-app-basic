<?php

/* @var $this View */

/* @var $content string */

use app\assets\AppBeginAsset;
use app\assets\AppEndAsset;
use yii\bootstrap4\Html;
use yii\web\View;

$asset = AppBeginAsset::register($this);
$charset = Yii::$app->charset;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= $charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>

<?= $content ?>

<?php AppEndAsset::register($this); ?>
<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
