<?php

namespace app\modules\product\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\db\Query;
use yii\widgets\ActiveForm;
use app\modules\product\models\ProductForm;
use app\modules\product\models\CategoryForm;


/**
 * Default controller for the `product` module
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
                                        'category',
                                        'category-create',
                                        'category-update',
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
                        'tp.product_id',
                        'tp.product_barcode',
                        'tp.product_name',
                        'tp.product_location',
                        'tp.product_sale_price',
                        'tp.product_sale_discount',
                        'tp.product_status',
                        'tp.userid',
                        'pc.category_name'
                    ])
                    ->from('tbl_product tp')
                    ->leftJoin('tbl_product_category pc', 'pc.category_id = tp.category_id')
                    ->where('1');
                    
        if($search !== '')
        {
            $query->andWhere('lower(tp.product_barcode) LIKE "%'.$search.'%" OR lower(tp.product_name) LIKE  "%'.$search.'%"');
        }

        if($category !== '' AND is_numeric($category) AND $category > 0)
        {
            $query->andWhere(['tp.category_id'=>$category]);
        }
  
        $countQuery = clone $query;
        $pageSize = 10;
        $pages = new Pagination([
                'totalCount' => $countQuery->count(), 
                'pageSize'=>$pageSize
            ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['product_id'=>SORT_DESC])
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
        $model = new ProductForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($post = $model->create()) {
                Yii::$app->session->setFlash('success', "Create New Product");
                return Yii::$app->getResponse()->redirect(Yii::$app->homeUrl.'products');
            }

        }

        return $this->render('product_create', [
            'model' => $model,
        ]); 
    }

    public function actionUpdate($id)
    {
        $model = new ProductForm;
        $_model = $model->getProduct($id);
   
        if($_model)
        {
            if ($model->load(Yii::$app->request->post())) {                   
                if ($menu = $model->update($id)) {
                    Yii::$app->session->setFlash('success', "Update Product");
                    return $this->redirect(Yii::$app->homeUrl.'products');
                }
            }
            return $this->render('product_update', [
                'model' => $model,
                '_model' => $_model,
            ]);
        }
        else
        {
            return $this->redirect(Yii::$app->homeUrl.'products');
        }
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionCategory()
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
                        'tpc.category_id',
                        'tpc.category_name',
                        'tpc.category_status',
                        'tpc.userid',
                    ])
                    ->from('tbl_product_category tpc')
                    ->where('1');
                    
        if($search !== '')
        {
            $query->andWhere('lower(category_name) LIKE "%'.$search.'%" ');
        }
  
        $countQuery = clone $query;
        $pageSize = 10;
        $pages = new Pagination([
                'totalCount' => $countQuery->count(), 
                'pageSize'=>$pageSize
            ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['category_id'=>SORT_DESC])
            ->all();
            
        return $this->render('category_index', [
            'models' => $models,
            'pages' => $pages,
            'offset' =>$pages->offset,
            'page' =>$pages->page,
            'search' =>$search,
        ]);
    }

    public function actionCategoryCreate()
    {
        $model = new CategoryForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($post = $model->create()) {
                Yii::$app->session->setFlash('success', "Create New Category");
                return Yii::$app->getResponse()->redirect(Yii::$app->homeUrl.'category');
            }

        }

        return $this->render('category_create', [
            'model' => $model,
        ]); 
    }

    public function actionCategoryUpdate($id)
    {
        $model = new CategoryForm;
        $_model = $model->getCategory($id);
   
        if($_model)
        {
            if ($model->load(Yii::$app->request->post())) {                   
                if ($menu = $model->update($id)) {
                    Yii::$app->session->setFlash('success', "Update Category");
                    return $this->redirect(Yii::$app->homeUrl.'category');
                }
            }
            return $this->render('category_update', [
                'model' => $model,
                '_model' => $_model,
            ]);
        }
        else
        {
            return $this->redirect(Yii::$app->homeUrl.'category');
        }
    }
}
