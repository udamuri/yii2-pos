<?php
namespace app\modules\purchase\models;

use Yii;
use yii\base\Model;
use app\models\TableOrder;

/**
 * This is the model class for table "tbl_order".
 *
 * @property integer $order_id
 * @property integer $supplier_id
 * @property string $order_invoice
 * @property date $order_date
 * @property string $order_desc
 * @property integer $order_receive_status
 * @property integer $order_type
 * @property string $order_created_at
 * @property string $order_updated_at
 * @property integer $order_discount
 * @property double $order_total
 * @property integer $userid
 */

class OrderPurchaseForm extends Model
{
	
    public $order_id;
    public $supplier_id;
    public $order_invoice;
    public $order_date;
    public $order_desc;
    public $order_receive_status;
    public $order_type;
    public $order_discount;
    public $order_total;
    public $order_item = [];
    public $product_updated_at;
    public $userid;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          	
            ['supplier_id', 'required'],    
            ['supplier_id', 'integer'],
            
			['order_invoice', 'required'],
            ['order_invoice', 'filter', 'filter' => 'trim'],
            ['order_invoice', 'string', 'max' => 255],
            ['order_invoice', 'checkInvoiceAlias'],

            ['order_date', 'required'],
            //['order_date', 'safe'],
			['order_date', 'date', 'format'=>'yyyy-mm-dd'],

            ['order_desc', 'filter', 'filter' => 'trim'],
            ['order_desc', 'string', 'max' => 255],

            ['order_receive_status', 'required'],   
            ['order_receive_status', 'integer'],

            ['order_type', 'required'],   
            ['order_type', 'integer'],

            ['order_item', 'required'],   
            //['order_item', 'checkInvoiceItem'],
            ['order_item', 'each'],

            ['order_discount', 'required'],
            ['order_discount', 'double'], 

            ['order_total', 'required'],
            ['order_total', 'double'],
        ];
    }

    public function checkInvoiceAlias($attribute, $params)
    {
        $alias = $this->order_invoice;
        $model = TableOrder::find()->where(['order_invoice'=>$alias])->one();
        if(($model && $model->order_invoice != $this->order_invoice))
        {
            $this->addError($attribute, 'No Faktur Sudah Ada.');
        }
    }

    public function checkInvoiceItem($attribute, $params)
    {
        if(!is_array($this->order_item))
        {
            $this->addError($attribute, 'Item Masi Kosong');
        }
    }


    public function create()
    {
        if ($this->validate()) {
            $create = new TableOrder();
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
            $update = TableOrder::findOne($id);
        }

        return null;
    }
	
    public function delete($id)
    {

        $delete = TableOrder::findOne($id);
        if($delete)
        {
            return $delete->delete();
        }

        return null;  
    }

    public function getOrder($id)
    {
        $arrData = [];
        $get = TableOrder::findOne($id);
        if($get)
        {
            $arrData = [
               
            ];
            return $arrData;
        }

        return null;
    }
    
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'supplier_id' => 'Supplier',
            'order_invoice' => 'No Faktur',
            'order_date' => 'Tanggal Pemesanan',
            'order_desc' => 'Deskripsi',
            'order_receive_status' => 'Receive Status',
            'order_type' => 'Tipe Order',
            'order_created_at' => 'Created At',
            'order_updated_at' => 'Updated At',
            'order_discount' => 'Diskon',
            'order_total' => 'Total',
            'order_item' => 'Item',
            'userid' => 'User id',
        ];
    }
	
}
