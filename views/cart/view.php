<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<div class="container">
    <?php if (Yii::$app->session->hasFlash('success')):?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <?php echo Yii::$app->session->getFlash('success');?>
            </button>
        </div>
    <?php endif;?>
    <?php if (Yii::$app->session->hasFlash('error')):?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <?php echo Yii::$app->session->getFlash('error');?>
            </button>
        </div>
    <?php endif;?>

<?php if(!empty($_SESSION['cart'])){ ?>

    <div class="table-responsive ">
        <table class="table table-hover table-striped"></table>
        <table>
            <thead class="table-t">
            <tr>
                <th>Фото</th>
                <th>Наименование</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th> <span class="glyphicon glyphicon-remove" aria-hidden="true" ></span> </th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                <tr>
                    <td><?=$item['img']?></td>
                    <td><?=$item['name']?></td>
                    <td><?=$item['qty']?></td>
                    <td><?=$item['price']?></td>
                    <td><span class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></th></td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td colspan="4">Итого: </td>
                <td><?=$_SESSION['cart.qty']?></td>
            </tr>
            <tr>
                <td colspan="4">На сумму: </td>
                <td><?=$_SESSION['cart.sum']?></td>
            </tr>

            </tbody>
        </table>
    </div>

<?php }else {?>
    <h2>Корзина пуста</h2>
<?php }?>

<br>
<br>

<?php $form = ActiveForm::begin(); ?>
<?=$form->field($order, 'name')?>
<?=$form->field($order, 'email')?>
<?=$form->field($order, 'phone')?>
<?=$form->field($order, 'address')?>
<?=Html::submitButton('Заказать',['class'=>'btn btn-success'])?>
<?php $form = ActiveForm::end(); ?>
<br>
<br>
</div>