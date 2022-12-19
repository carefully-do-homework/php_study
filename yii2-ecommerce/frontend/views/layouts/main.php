<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => 'Shop in style',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-lg navbar-light bg-light fixed-top',

        ],
    ]);
    $menuItems = [
        [
            'label' => 'Home',
            'options' => [
                'style' => 'text-align:left; flex: 1'
            ],
            'url' => ['/site/index']
        ],
    ];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => yii::$app->user->identity->username,
            'items' => [
                [
                    'label' => 'profile',
                    'url' => ['site/profile'],
                ],
                [
                    'label' => 'logout',
                    'url' => ['site/logout'],
                    'linkOptions' => [
                        'data-method' => 'post'
                    ]
                ],
            ],
        ];
    }

    echo Nav::widget([
        'options' => [
            'class' => 'navbar-nav me-auto mb-2 mb-md-0',
            'style' => 'width: 100%'
        ],
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
