<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\TableSupplier;
?>

<?php $form = ActiveForm::begin([
                    'id' => $form_id,
                    //'layout' => 'horizontal',
                ]); 

        if($form_id === 'form-update-purchase')
        {
           
        }

?>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <?= $form->field($model, 'order_invoice')->textInput(); ?>

            <div class="row">
                <div class="col-md-6">
                    <?php
                        $dataList = ArrayHelper::map(TableSupplier::find()->all(), 'supplier_id', 'supplier_name'); 
                        $arrEmpty = ['0'=>'--Pilih--'];
                        $array_merge = array_merge($arrEmpty, $dataList);

                        echo $form->field($model, 'supplier_id')
                            ->dropDownList(
                                $array_merge,           // Flat array ('id'=>'label')
                                ['prompt'=>'']    // options
                            );
                    ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'order_date')->textInput(); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">
        <?= $form->field($model, 'order_desc')->textArea(['rows' => '4']); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <hr>
        </div> 
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

        </div> 
    </div

    <div class="form-group">
        <?= Html::submitButton($button, ['class' => 'btn btn-primary', 'name' => 'category-button']) ?>
    </div>

<?php ActiveForm::end(); ?>


