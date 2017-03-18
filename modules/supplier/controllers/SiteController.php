<?php

namespace app\modules\supplier\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\db\Query;
use yii\widgets\ActiveForm;
use app\modules\supplier\models\SupplierForm;

/**
 * Default controller for the `supplier` module
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
                $search =  strtolower(trim(strip_tags($_GET['search'])));  
            }
        }
    
        $query = (new \yii\db\Query())
                    ->select([
                        's.supplier_id',
                        's.supplier_name',
                        's.supplier_contact_person',
                        's.supplier_address',
                        's.supplier_phone1',
                        's.supplier_phone2',
                        's.supplier_status',
                        's.userid',
                    ])
                    ->from('tbl_supplier s')
                    ->where('1');
                    
        if($search !== '')
        {
            $query->andWhere('lower(supplier_name) LIKE "%'.$search.'%" OR 
            	lower(supplier_contact_person) LIKE  "%'.$search.'%" OR
            	lower(supplier_address) LIKE  "%'.$search.'%" OR
            	lower(supplier_phone1) LIKE  "%'.$search.'%" OR
            	lower(supplier_phone2) LIKE  "%'.$search.'%"
            	');
        }
  
        $countQuery = clone $query;
        $pageSize = 10;
        $pages = new Pagination([
                'totalCount' => $countQuery->count(), 
                'pageSize'=>$pageSize
            ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['supplier_id'=>SORT_DESC])
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

    public function actionCreate()
    {
        $model = new SupplierForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($post = $model->create()) {
                Yii::$app->session->setFlash('success', "Create New Supplier");
                return Yii::$app->getResponse()->redirect(Yii::$app->homeUrl.'suppliers');
            }

        }

        return $this->render('supplier_create', [
            'model' => $model,
        ]); 
    }

    public function actionUpdate($id)
    {
        $model = new SupplierForm;
        $_model = $model->getSupplier($id);
   
        if($_model)
        {
            if ($model->load(Yii::$app->request->post())) {                   
                if ($menu = $model->update($id)) {
                    Yii::$app->session->setFlash('success', "Update Supplier");
                    return $this->redirect(Yii::$app->homeUrl.'suppliers');
                }
            }
            return $this->render('supplier_update', [
                'model' => $model,
                '_model' => $_model,
            ]);
        }
        else
        {
            return $this->redirect(Yii::$app->homeUrl.'suppliers');
        }
    }
}
