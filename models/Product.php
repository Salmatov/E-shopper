<?php

namespace app\models;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    static function tableName()
    {
        return 'product';
    }

    public function getCategory(){
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}

