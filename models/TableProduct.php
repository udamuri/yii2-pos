<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_product".
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
 */
class TableProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_barcode', 'product_name', 'product_sale_price', 'product_sale_discount', 'product_created_at', 'product_updated_at', 'userid'], 'required'],
            [['product_sale_price', 'product_sale_discount'], 'number'],
            [['product_status', 'userid'], 'integer'],
            [['product_created_at', 'product_updated_at'], 'safe'],
            [['product_barcode'], 'string', 'max' => 255],
            [['product_name'], 'string', 'max' => 150],
            [['product_location'], 'string', 'max' => 50],
            [['product_barcode'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'product_barcode' => 'Product Barcode',
            'product_name' => 'Product Name',
            'product_location' => 'Product Location',
            'product_sale_price' => 'Product Sale Price',
            'product_sale_discount' => 'Product Sale Discount',
            'product_status' => 'Product Status',
            'product_created_at' => 'Product Created At',
            'product_updated_at' => 'Product Updated At',
            'userid' => 'Userid',
        ];
    }
}
