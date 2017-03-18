<?php
namespace app\modules\product\models;

use Yii;
use yii\base\Model;
use app\models\TableProduct;

/**
 * This is the model class for table "Model product".
 *
 * @property integer $product_id
 * @property string $product_barcode
 * @property string $product_name
 * @property string $product_location
 * @property double $product_sale_price
 * @property double $product_sale_discount
 * @property integer $product_status
 * @property string $product_created_at
 * @property string $product_updated_at
 * @property integer $userid
 * @property integer $category_id
 */

class ProductForm extends Model
{
	
    public $product_id;
    public $product_barcode;
    public $product_name;
    public $product_location;
    public $product_sale_price;
    public $product_sale_discount;
    public $product_status;
    public $product_created_at;
    public $product_updated_at;
    public $userid;
    public $category_id;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          			
            ['product_id', 'integer'],
            
            ['category_id', 'required'],            
            ['category_id', 'integer'],

			['product_barcode', 'required'],
            ['product_barcode', 'filter', 'filter' => 'trim'],
            ['product_barcode', 'string', 'max' => 255],
			['product_barcode', 'checkBarcodeAlias'],
            //['product_barcode', 'unique', 'targetClass' => '\app\models\TableProduct', 'message' => 'This Barcecode has already been taken.'],

            ['product_name', 'required'],
            ['product_name', 'filter', 'filter' => 'trim'],
            ['product_name', 'string', 'max' => 150],

            ['product_location', 'filter', 'filter' => 'trim'],
            ['product_location', 'string', 'max' => 50],

            ['product_sale_price', 'required'],
            ['product_sale_price', 'double'],

            ['product_sale_discount', 'required'],
            ['product_sale_discount', 'double', 'min' => 0, 'max' => 100],
        ];
    }

    public function checkBarcodeAlias($attribute, $params)
    {
        $alias = $this->product_barcode;
        $model = TableProduct::find()->where(['product_barcode'=>$alias])->one();
        if(($model && $model->product_id != $this->product_id))
        {
            $this->addError($attribute, 'This barcode has already been taken.');
        }
    }


    public function create()
    {
        if ($this->validate()) {
            $create = new TableProduct();
            $create->product_barcode = $this->product_barcode;
            $create->category_id = $this->category_id;
            $create->product_name = $this->product_name;
            $create->product_location = $this->product_location;
            $create->product_sale_price = $this->product_sale_price;
            $create->product_sale_discount = $this->product_sale_discount;
            $create->product_status = 1;
            $create->product_created_at = date('Y-m-d H:i:s');
            $create->product_updated_at = date('Y-m-d H:i:s');
            $create->userid = Yii::$app->user->identity->id;
            if ($create->save(false)) {
                 return true;
            }
        }

        return null;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function update($id)
    {
        if ($this->validate()) {
            $update = TableProduct::findOne($id);
            $update->product_barcode = $this->product_barcode;
            $update->category_id = $this->category_id;
            $update->product_name = $this->product_name;
            $update->product_location = $this->product_location;
            $update->product_sale_price = $this->product_sale_price;
            $update->product_sale_discount = $this->product_sale_discount;
            $update->product_updated_at = date('Y-m-d H:i:s');
            if ($update->save(false)) {
                 return true;
            }
        }

        return null;
    }
	
    public function delete($id)
    {

        $delete = TableProduct::findOne($id);
        if($delete)
        {
            return $delete->delete();
        }

        return null;  
    }

    public function getProduct($id)
    {
        $arrData = [];
        $get = TableProduct::findOne($id);
        if($get)
        {
            $arrData = [
                'product_id'=>$get['product_id'],
                'category_id'=>$get['category_id'],
                'product_barcode'=>$get['product_barcode'],
                'product_name'=>$get['product_name'],
                'product_location'=>$get['product_location'],
                'product_sale_price'=>$get['product_sale_price'],
                'product_sale_discount'=>$get['product_sale_discount'],
            ];
            return $arrData;
        }

        return null;
    }

    public function setStatus($id)
    {
        $set = TableProduct::findOne($id);

        if($set)
        {
            if($set->product_status == 1)
            {
                $set->product_status = 0;
            }
            else
            {
                $set->product_status = 1 ;
            }
            $set->save(false);
            return $set->product_status;
        }

        return false;
    }
    
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'ID',
            'product_barcode' => 'Barcode',
            'product_name' => 'Nama',
            'product_location' => 'Lokasi',
            'product_sale_price' => 'Harga Jual',
            'product_sale_discount' => 'Diskon',
            'product_status' => 'Status',
            'product_created_at' => 'Created At',
            'product_updated_at' => 'Updated At',
            'userid' => 'User Id',
            'category_id' => 'Kategori',
        ];
    }
	
}
