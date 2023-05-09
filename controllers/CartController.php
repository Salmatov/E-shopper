<?php

namespace app\controllers;
use app\models\Product;
use Yii;
use app\models\Cart;
use app\models\OrderItems;
use app\models\Order;

class CartController extends AppController
{
    public function actionAdd(){

        $id=Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if(empty($product)) return false;
        $session = Yii::$app->session;
        $session->open();
        $cart= new Cart();
        $cart -> addToCart($product);
        $this->layout = false;
        return $this->render('cart-modal',['session'=>$session]);

    } public function actionsClear(){

        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.sum');
        $session->remove('cart.qty');
        $this->layout = false;
        return $this->render('cart-modal',['session'=>$session]);

    }

    public function actionView(){
        $session = Yii::$app->session;
        $session->open();
        $this->setMeta('Корзина');
        $order = new Order();
        if($order->load(Yii::$app->request->post())){
            $order->save();
            debug($order->getErrors());
            //debug(Yii::$app->request->post());
        }

        return $this->render('view',['session'=>$session, 'order'=>$order]);
    }
}
