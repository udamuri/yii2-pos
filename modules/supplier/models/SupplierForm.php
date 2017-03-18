<?php
namespace app\modules\supplier\models;

use Yii;
use yii\base\Model;
use app\models\TableSupplier;

/**
 * This is the model class for table "model supplier".
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

class SupplierForm extends Model
{
	
    public $supplier_id;
    public $supplier_name;
    public $supplier_contact_person;
    public $supplier_address;
    public $supplier_phone1;
    public $supplier_phone2;
    public $supplier_status;
    public $supplier_created_at;
    public $supplier_updated_at;
    public $userid;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['supplier_name', 'required'],
            ['supplier_name', 'filter', 'filter' => 'trim'],
            ['supplier_name', 'string', 'max' => 150],

            ['supplier_contact_person', 'required'],
            ['supplier_contact_person', 'filter', 'filter' => 'trim'],
            ['supplier_contact_person', 'string', 'max' => 100],

            ['supplier_address', 'filter', 'filter' => 'trim'],
            ['supplier_address', 'string', 'max' => 255],

            ['supplier_phone1', 'filter', 'filter' => 'trim'],
            ['supplier_phone1', 'string', 'max' => 20],

            ['supplier_phone2', 'filter', 'filter' => 'trim'],
            ['supplier_phone2', 'string', 'max' => 20],
        ];
    }

    public function create()
    {
        if ($this->validate()) {
            $create = new TableSupplier();
            $create->supplier_name = $this->supplier_name;
            $create->supplier_contact_person = $this->supplier_contact_person;
            $create->supplier_address = $this->supplier_address;
            $create->supplier_phone1 = $this->supplier_phone1;
            $create->supplier_phone2 = $this->supplier_phone2;
            $create->supplier_status = 1;
            $create->supplier_created_at = date('Y-m-d H:i:s');
            $create->supplier_updated_at = date('Y-m-d H:i:s');
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
            $update = TableSupplier::findOne($id);
            $update->supplier_name = $this->supplier_name;
            $update->supplier_contact_person = $this->supplier_contact_person;
            $update->supplier_address = $this->supplier_address;
            $update->supplier_phone1 = $this->supplier_phone1;
            $update->supplier_phone2 = $this->supplier_phone2;
            $update->supplier_updated_at = date('Y-m-d H:i:s');
            if ($update->save(false)) {
                 return true;
            }
        }

        return null;
    }
	
    public function delete($id)
    {

        $delete = TableSupplier::findOne($id);
        if($delete)
        {
            return $delete->delete();
        }

        return null;  
    }

    public function getSupplier($id)
    {
        $arrData = [];
        $get = TableSupplier::findOne($id);
        if($get)
        {
            $arrData = [
                'supplier_id'=>$get['supplier_id'],
                'supplier_name'=>$get['supplier_name'],
                'supplier_contact_person'=>$get['supplier_contact_person'],
                'supplier_address'=>$get['supplier_address'],
                'supplier_phone1'=>$get['supplier_phone1'],
                'supplier_phone2'=>$get['supplier_phone2'],
                'supplier_status'=>$get['supplier_status'],
            ];
            return $arrData;
        }

        return null;
    }

    public function setStatus($id)
    {
        $set = TableSupplier::findOne($id);

        if($set)
        {
            if($set->supplier_status == 1)
            {
                $set->supplier_status = 0;
            }
            else
            {
                $set->supplier_status = 1 ;
            }
            $set->save(false);
            return $set->supplier_status;
        }

        return false;
    }
    
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'supplier_id' => 'ID',
            'supplier_name' => 'Name',
            'supplier_contact_person' => 'Kontak Person',
            'supplier_address' => 'Alamat',
            'supplier_phone1' => 'Telfon 1',
            'supplier_phone2' => 'Telfon 2',
            'supplier_status' => 'Status',
            'supplier_created_at' => 'Created At',
            'supplier_updated_at' => 'Updated At',
            'userid' => 'User Id',
        ];
    }
	
}
