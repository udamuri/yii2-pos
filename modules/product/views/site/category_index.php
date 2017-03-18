<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Category';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::$app->homeUrl."js/index.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."js/product.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$token = $this->renderDynamic('return Yii::$app->request->csrfToken;');

$jsx = <<< 'SCRIPT'
    IndexObj.initialScript();
    ProductObj.initialScript();
SCRIPT;
$this->registerJs('IndexObj.baseUrl = "'. Yii::$app->homeUrl.'"', \yii\web\View::POS_HEAD);
$this->registerJs('IndexObj.csrfToken = "'. $token.'"',  \yii\web\View::POS_HEAD);
$this->registerJs($jsx);


?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <a href="<?=Yii::$app->homeUrl;?>category/create" class="btn btn-success">Add New</a>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <form  id="searchform" action="<?=Yii::$app->homeUrl;?>category"  method="GET" >
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12"> 
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" value="<?=$search;?>" placeholder="Search for...">
                  
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit">Go!</button>
                    </span>
                  </div>
              </div>
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
                  <td>Name</td>
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
                    if($value['category_status'] == '1')
                    {
                      $btn_class = 'btn-primary';
                      $btn_text = 'ON';
                    }
                    echo '<tr>
                        <td>'.$start.'</td>
                        <td>'.$value['category_name'].'</td>
                        <td align="center">
                          <a class="btn btn-success btn-xs" title="Update" href="'.Yii::$app->homeUrl.'category/update/'.$value['category_id'].'" data-id="'.$value['category_id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                          <button id="btn_status_post_'.$value['category_id'].'" title="Status" class="btn '.$btn_class.' btn-xs status_post" data-id="'.$value['category_id'].'"> '.$btn_text.' </button>
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