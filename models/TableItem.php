<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_item".
 *
 * @property integer $item_id
 * @property integer $order_id
 * @property string $product_id
 * @property string $item_name
 * @property double $item_price
 * @property double $item_discount
 * @property string $item_unit
 * @property integer $item_unit_qty
 * @property integer $item_qty
 */
class TableItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'item_name', 'item_price', 'item_discount', 'item_unit', 'item_unit_qty', 'item_qty'], 'required'],
            [['order_id', 'item_unit_qty', 'item_qty'], 'integer'],
            [['item_price', 'item_discount'], 'number'],
            [['product_id', 'item_name', 'item_unit'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'item_name' => 'Item Name',
            'item_price' => 'Item Price',
            'item_discount' => 'Item Discount',
            'item_unit' => 'Item Unit',
            'item_unit_qty' => 'Item Unit Qty',
            'item_qty' => 'Item Qty',
        ];
    }
}
