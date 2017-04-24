<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Pembelian';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::$app->homeUrl."js/index.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."js/purchase.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$token = $this->renderDynamic('return Yii::$app->request->csrfToken;');

$jsx = <<< 'SCRIPT'
    IndexObj.initialScript();
    PurchaseObj.initialScript();
SCRIPT;
$this->registerJs('IndexObj.baseUrl = "'. Yii::$app->homeUrl.'"', \yii\web\View::POS_HEAD);
$this->registerJs('IndexObj.csrfToken = "'. $token.'"',  \yii\web\View::POS_HEAD);
$this->registerJs($jsx);


?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <a href="<?=Yii::$app->homeUrl;?>purchase/create" class="btn btn-success">Tambah Baru</a>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <form  id="searchform" action="<?=Yii::$app->homeUrl;?>products"  method="GET" >
          <div class="input-group">
            <input type="text" name="search" class="form-control" value="<?=$search;?>" placeholder="Search for...">
          
            <span class="input-group-btn">
              <button class="btn btn-default" type="submit">Go!</button>
            </span>
          </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <hr class="row-header">
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr class="bg-pos">
                  <td width="3%">No.</td>
                  <td>No Faktur</td>
                  <td>Supplier</td>
                  <td>Deskripsi</td>
                  <td>Total</td>
                  <td width="13%">Action</td>
              </tr>
            </thead>
            <tbody>
            <?php
                $start = (int)$offset * (int)$page;
                foreach ($models as $value) {
                    $start++;
                    $btn_class = 'btn-warning';
                    $btn_text = 'OFF';
                    if($value['product_status'] == '1')
                    {
                      $btn_class = 'btn-primary';
                      $btn_text = 'ON';
                    }
                    echo '<tr>
                        <td>'.$start.'</td>
                        <td>'.$value['order_invoice'].'</td>
                        <td>'.$value['supplier_id'].'</td>
                        <td>'.$value['order_desc'].'</td>
                        <td>'.$value['order_total'].'</td>
                        <td class="text-right" >'.$value['product_sale_discount'].'%</td>
                        <td align="center">
                          <a class="btn btn-success btn-xs" title="Update" href="'.Yii::$app->homeUrl.'product/update/'.$value['order_id'].'" data-id="'.$value['order_id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                          <button id="btn_status_post_'.$value['order_id'].'" title="Status" class="btn '.$btn_class.' btn-xs status_post" data-id="'.$value['order_id'].'"> '.$btn_text.' </button>
                        </td>
                    <tr>';
                }
            ?>
            </tbody>
          </table>
      </div>
    </div>
</div> 

<div class="row">
    <div class="col-md-12">
        <div class="text-center">
          <?php
              //display pagination
              echo LinkPager::widget([
                  'pagination' => $pages,
              ]);
          ?>
        </div>
    </div>
</div>     