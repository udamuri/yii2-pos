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

    <div class="row margin-bottom10">
        <div class="col-md-10 col-sm-12 col-xs-12">
            <input type="text" class="form-control" name="">    
        </div>

        <div class="col-md-2 col-sm-12 col-xs-12">
            <button id="btn-find" class="btn btn-success btn-block" type="button">Find</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="table-resposnsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-pos">
                            <th class="text-center">Kode</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Harga Beli</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Subtotal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="detail-item">
                        <?php for($i=1;$i<=3;$i++) { ?>
                        <tr>
                            <td>1234</td>
                            <td>Sampo 1</td>
                            <td>18.000,00</td>
                            <td>1</td>
                            <td>18.000,00</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1235</td>
                            <td>Sampo 2</td>
                            <td>18.000,00</td>
                            <td>1</td>
                            <td>18.000,00</td>
                            <td></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="6" class="text-right">
                                <b>Total : Rp.750.000,00</b>
                                <?= $form->field($model, 'order_total')->textInput(['class'=>'form-control text-right hidden'])->label(false); ?>    
                                    </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> 
    </div

    <div class="form-group">
        <?= Html::submitButton($button, ['class' => 'btn btn-primary', 'name' => 'category-button']) ?>
    </div>

<?php ActiveForm::end(); ?>


