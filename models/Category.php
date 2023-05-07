<?php

namespace app\models;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    static function tableName()
    {
        return 'category';
    }

    public function getProduct(){
        return $this->hasMany(Product::class,['category_id'=>'id']);
    }

}