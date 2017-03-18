<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_product_category".
 *
 * @property integer $category_id
 * @property string $category_name
 * @property integer $category_status
 * @property string $category_created_at
 * @property string $category_updated_at
 * @property integer $userid
 */
class TableProductCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name', 'category_created_at', 'category_updated_at', 'userid'], 'required'],
            [['category_status', 'userid'], 'integer'],
            [['category_created_at', 'category_updated_at'], 'safe'],
            [['category_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
            'category_status' => 'Category Status',
            'category_created_at' => 'Category Created At',
            'category_updated_at' => 'Category Updated At',
            'userid' => 'Userid',
        ];
    }
}
