<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string|null $keywords
 * @property string|null $description
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 80],
            [['keywords', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Категории',
            'parent_id' => 'Родительская категория',
            'name' => 'Имя',
            'keywords' => 'Ключивые слова',
            'description' => 'Описание',
        ];
    }

    public function getCategory(){
        return $this->hasOne(Category::class,['id'=>'parent_id']);
    }
}
