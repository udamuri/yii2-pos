<?php

namespace app\modules\purchase\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\db\Query;
use yii\widgets\ActiveForm;

/**
 * Default controller for the `purchase` module
 */
class SiteController extends Controller
{
    /*
	* @inheritdoc
    */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                        				'index', 
                        				'create',
                        				'update',
                                    ],
                        'allow' => true,
                        'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
						   return Yii::$app->mycomponent->isUserRole('admin', Yii::$app->user->identity->level);
						}
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $search = '';
        $category = '';
        if($get = Yii::$app->request->get())
        {
            if(isset($get['search']))
            {
                $search =  strtolower(trim(strip_tags($get['search'])));  
            }

            if(isset($get['category']))
            {
                $category =  strtolower(trim(strip_tags($get['category'])));  
            }
        }

        $query = (new \yii\db\Query())
                    ->select([
                        'tp.order_id',
                        'tp.supplier_id',
                        'tp.order_invoice',
                        'tp.order_desc',
                        'tp.order_receive_status',
                        'tp.order_receive_status',
                        'tp.order_type',
                        'tp.order_discount',
                        'tp.userid'
                    ])
                    ->from('tbl_order tp')
                    ->where('1');

        $countQuery = clone $query;
        $pageSize = 10;
        $pages = new Pagination([
                'totalCount' => $countQuery->count(), 
                'pageSize'=>$pageSize
            ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['order_id'=>SORT_DESC])
            ->all();
            
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'offset' =>$pages->offset,
            'page' =>$pages->page,
            'search' =>$search,
            'category' =>$category
        ]);
    }
}
