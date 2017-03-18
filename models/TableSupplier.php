<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_supplier".
 *
 * @property integer $supplier_id
 * @property string $supplier_name
 * @property string $supplier_contact_person
 * @property string $supplier_address
 * @property string $supplier_phone1
 * @property string $supplier_phone2
 * @property integer $supplier_status
 * @property string $supplier_created_at
 * @property string $supplier_updated_at
 * @property integer $userid
 */
class TableSupplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_supplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_name', 'supplier_contact_person', 'supplier_created_at', 'supplier_updated_at', 'userid'], 'required'],
            [['supplier_status', 'userid'], 'integer'],
            [['supplier_created_at', 'supplier_updated_at'], 'safe'],
            [['supplier_name'], 'string', 'max' => 150],
            [['supplier_contact_person'], 'string', 'max' => 100],
            [['supplier_address'], 'string', 'max' => 255],
            [['supplier_phone1', 'supplier_phone2'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'supplier_id' => 'Supplier ID',
            'supplier_name' => 'Supplier Name',
            'supplier_contact_person' => 'Supplier Contact Person',
            'supplier_address' => 'Supplier Address',
            'supplier_phone1' => 'Supplier Phone1',
            'supplier_phone2' => 'Supplier Phone2',
            'supplier_status' => 'Supplier Status',
            'supplier_created_at' => 'Supplier Created At',
            'supplier_updated_at' => 'Supplier Updated At',
            'userid' => 'Userid',
        ];
    }
}
