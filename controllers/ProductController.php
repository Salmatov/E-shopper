<?php

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;

class ProductController extends AppController
{
    public function actionView($id){
        $product = Product::findOne($id);
        if (empty($product)){
            throw new \yii\web\HttpException(404, 'Нет такого товара.');

        }
        $id = Yii::$app->request->get('id');
        return $this->render('view',['product'=>$product]);
    }
}