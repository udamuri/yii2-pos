<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\TableForum */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <?php $form = ActiveForm::begin([
                            'id' => $form_id,
                            //'layout' => 'horizontal',
                        ]); 
                $model->product_sale_discount = 0;
                if($form_id === 'form-update-product')
                {
                    $model->product_id = $_model['product_id'] ;
                    $model->product_barcode = $_model['product_barcode'] ;
                    $model->product_name = $_model['product_name'] ;
                    $model->product_location = $_model['product_location'] ;
                    $model->product_sale_price = $_model['product_sale_price'] ;
                    $model->product_sale_discount = $_model['product_sale_discount'] ;
                }

        ?>
                <?=$form->field($model, 'product_id',['options' => ['value'=> 0] ])->hiddenInput()->label(false);?>
                <?= $form->field($model, 'product_barcode')->textInput(); ?>
                <?= $form->field($model, 'product_name')->textInput(); ?>
                <?= $form->field($model, 'product_location')->textInput(); ?>
                <?= $form->field($model, 'product_sale_price')->textInput(); ?>
                <?= $form->field($model, 'product_sale_discount')->textInput(); ?>

                <div class="form-group">
                    <?= Html::submitButton($button, ['class' => 'btn btn-primary', 'name' => 'product-button']) ?>
                </div>

        <?php ActiveForm::end(); ?>   
    </div>
</div>


