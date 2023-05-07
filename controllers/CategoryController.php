<?php

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;

class CategoryController extends AppController
{

    public function actionIndex()
    {
        $hits = Product::find()
            ->where(['hit' => '1'])
            ->all();

        $this->setMeta('E-SHOPPER');
        return $this->render('index', ['hits' => $hits]);
    }

    public function actionTest()
    {


        $hits = Product::find()
            ->select(['id'])
            ->where(['hit' => '1'])
            ->limit(1)
            ->all();

        debug ($hits);
/*
                $this->setMeta('E-SHOPPER');
                return $this->render('index', ['hits' => $hits]);*/

        //$hits = Product::find()->where(['hit'=>'1'])->all();
        //$this->setMeta('E-SHOPPER');
        //return $this->render('test1',['hits'=>$hits]);
        //echo 'hello';
        //$connectMysql = new mysqli('locolhost','root','root','shop');
        //$products = $connectMysql->query("SELECT * FROM 'product'");
        //while ($result = $products->fetch_assoc()){

    }
    //var_dump($result);



    public function actionView($id){

       /* $req = Yii::$app;
        debug($req);*/
        $category = Category::findOne($id);
        if (empty($category)){
            throw new \yii\web\HttpException(404, 'Нет такой категории.');

        }

        $id = Yii::$app->request->get('id');
//        $products = Product::find()->where(['category_id'=>$id])->all();
        $query = Product::find()->where(['category_id'=>$id]);
        $pages = new Pagination(['totalCount'=> $query->count(), 'pageSize'=>3,
            'forcePageParam'=>false, 'pageSizeParam'=>false]);
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $this->setMeta('E-SHOPPER | ' . $category->name, $category->keywords, $category->description,);
        return $this->render('view',['products'=>$products,'pages'=>$pages,'category'=>$category]);
    }




}