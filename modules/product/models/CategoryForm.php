<?php
namespace app\modules\product\models;

use Yii;
use yii\base\Model;
use app\models\TableProductCategory;

/**
 * This is the model class for table "model product category".
 *
 * @property integer $category_id
 * @property string $category_name
 * @property integer $category_status
 * @property string $category_created_at
 * @property string $category_updated_at
 * @property integer $userid
 */

class CategoryForm extends Model
{
	
    public $category_id;
    public $category_name;
    public $category_status;
    public $category_created_at;
    public $category_updated_at;
    public $userid;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          			
            //['category_id', 'integer'],

			['category_name', 'required'],
            ['category_name', 'filter', 'filter' => 'trim'],
            ['category_name', 'string', 'max' => 150],

        ];
    }

   
    public function create()
    {
        if ($this->validate()) {
            $create = new TableProductCategory();
            $create->category_name = $this->category_name;
            $create->category_status = 1;
            $create->category_created_at = date('Y-m-d H:i:s');
            $create->category_updated_at = date('Y-m-d H:i:s');
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
            $update = TableProductCategory::findOne($id);
            $update->category_name = $this->category_name;
            $update->category_updated_at = date('Y-m-d H:i:s');
            if ($update->save(false)) {
                 return true;
            }
        }

        return null;
    }
	
    public function delete($id)
    {

        $delete = TableProductCategory::findOne($id);
        if($delete)
        {
            return $delete->delete();
        }

        return null;  
    }

    public function getCategory($id)
    {
        $arrData = [];
        $get = TableProductCategory::findOne($id);
        if($get)
        {
            $arrData = [
                'category_id'=>$get['category_id'],
                'category_name'=>$get['category_name'],
            ];
            return $arrData;
        }

        return null;
    }

    public function setStatus($id)
    {
        $set = TableProductCategory::findOne($id);

        if($set)
        {
            if($set->category_status == 1)
            {
                $set->category_status = 0;
            }
            else
            {
                $set->category_status = 1 ;
            }
            $set->save(false);
            return $set->category_status;
        }

        return false;
    }
    
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'ID',
            'category_name' => 'Nama',
            'category_status' => 'Status',
            'category_created_at' => 'Created At',
            'category_updated_at' => 'Updated At',
            'userid' => 'Userid',
        ];
    }
	
}
