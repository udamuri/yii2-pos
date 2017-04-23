<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\LoginAsset;
use app\widgets\Myalert;
use yii\bootstrap\ActiveForm;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>LOGIN</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">
                        <!-- <p>Please fill out the following fields to login:</p> -->
                        <?php $model->rememberMe = 0;?>
                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                        ]); ?>

                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <?= $form->field($model, 'rememberMe')->checkbox(['checked'=>false]) ?>

                            <div class="form-group">
                                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
