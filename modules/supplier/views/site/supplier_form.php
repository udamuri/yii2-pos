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

                if($form_id === 'form-update-supplier')
                {
                    $model->supplier_name = $_model['supplier_name'] ;
                    $model->supplier_contact_person = $_model['supplier_contact_person'] ;
                    $model->supplier_phone1 = $_model['supplier_phone1'] ;
                    $model->supplier_phone2 = $_model['supplier_phone2'] ;
                    $model->supplier_address = $_model['supplier_address'] ;
                }

        ?>
                <?= $form->field($model, 'supplier_name')->textInput(); ?>
                <?= $form->field($model, 'supplier_contact_person')->textInput(); ?>
                <?= $form->field($model, 'supplier_phone1')->textInput(); ?>
                <?= $form->field($model, 'supplier_phone2')->textInput(); ?>
                <?= $form->field($model, 'supplier_address')->textArea(); ?>

                <div class="form-group">
                    <?= Html::submitButton($button, ['class' => 'btn btn-primary', 'name' => 'supplier-button']) ?>
                </div>

        <?php ActiveForm::end(); ?>   
    </div>
</div>


