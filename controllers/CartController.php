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
            $order->qty=$session['cart.qty'];
            $order->sum=$session['cart.sum'];
            if($order->save()){
                Yii::$app->mailer->compose()
                    ->setFrom(['salmatov90@rambler.ru'=>'Салматов'])
                    ->setTo($order->email)
                    ->setSubject('Заказ')
                    ->setTextBody('Ваш заказ оформлен')
                    ->send();
                $this->saveOrderItems($session['cart'],$order->id);
                Yii::$app->session->setFlash('success','Заказ оформлен');
                $session->remove('cart');
                $session->remove('cart.sum');
                $session->remove('cart.qty');
                return $this->refresh();
            }else {
                Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
            }
        }
        return $this->render('view',['session'=>$session, 'order'=>$order]);
    }

    public function saveOrderItems($items,$order_id){
        foreach ($items as $id=>$item){
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['qty'] * $item['price'];
            $order_items->save();


        }
    }

}
