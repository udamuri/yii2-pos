<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_order".
 *
 * @property integer $order_id
 * @property integer $supplier_id
 * @property string $order_invoice
 * @property string $order_desc
 * @property integer $order_receive_status
 * @property integer $order_type
 * @property string $order_created_at
 * @property string $order_updated_at
 * @property integer $order_discount
 * @property double $order_total
 * @property integer $userid
 */
class TableOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id', 'order_invoice', 'order_desc', 'order_created_at', 'order_updated_at', 'order_total', 'userid'], 'required'],
            [['supplier_id', 'order_receive_status', 'order_type', 'order_discount', 'userid'], 'integer'],
            [['order_created_at', 'order_updated_at', 'order_date'], 'safe'],
            [['order_total'], 'number'],
            [['order_invoice', 'order_desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'supplier_id' => 'Supplier ID',
            'order_invoice' => 'Order Invoice',
            'order_date' => 'Order Date',
            'order_desc' => 'Order Desc',
            'order_receive_status' => 'Order Receive Status',
            'order_type' => 'Order Type',
            'order_created_at' => 'Order Created At',
            'order_updated_at' => 'Order Updated At',
            'order_discount' => 'Order Discount',
            'order_total' => 'Order Total',
            'userid' => 'Userid',
        ];
    }
}
