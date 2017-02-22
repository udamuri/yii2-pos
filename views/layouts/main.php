<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\Myalert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class'=>'container-fluid'],
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);

    $menuItems = [
        ['label' => 'Kasir', 'url' => ['/home']],
    ];

    if(Yii::$app->user->isGuest)
    {
        $menuItems[] = ['label' => 'Login', 'url' => ['/login']];
    }
    else
    {
        $menuItems[] = '<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Transaction <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="'.Yii::$app->homeUrl.'suppliers">Suppliers</a></li>
                            <li><a href="'.Yii::$app->homeUrl.'category">Category</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="'.Yii::$app->homeUrl.'products">Product</a></li>
                        </ul>
                      </li>';

        $menuItems[] = '<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Master Data <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="'.Yii::$app->homeUrl.'suppliers">Suppliers</a></li>
                            <li><a href="'.Yii::$app->homeUrl.'category">Category</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="'.Yii::$app->homeUrl.'products">Product</a></li>
                        </ul>
                      </li>';

        $menuItems[] = '<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.Yii::$app->user->identity->username.' <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="javascript:void(0)">User Setting</a></li>
                          <li><a href="javascript:void(0)">Pos Setting</a></li>
                          <li role="separator" class="divider"></li>
                          <li>
                            '.Html::beginForm(['/site/logout'], 'post').'
                            '.Html::submitButton('Logout', ['class' => 'btn btn-link logout'] ).'                
                            '.Html::endForm().'
                            </li>
                        </ul>
                      </li>';
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <div class="row">
            <div class="col-md-12">
                <?=Myalert::widget(); ?>
            </div>
        </div>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container-fluid">
        <p class="pull-left">&copy; Muri <?= date('Y') ?></p>

        <!-- <p class="pull-right">Muri Budiman</p> -->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
