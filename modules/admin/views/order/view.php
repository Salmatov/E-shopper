<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Order $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1>Просмотр заказа №<?= $model->id ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'qty',
            [
                'attribute'=>'status',
                'value'=> !$model->status?'<span class="text-danger">Активно </span>':'<span class="text-success">Завершено</span>'
                ,
                'format'=>'html',
            ],
            'sum',
//            'status',
            'name',
            'email:email',
            'phone',
            'address',
        ],
    ]) ?>
    <?php  $items = $model->orderItem ;?>

    <div class="table-responsive ">
        <table class="table table-hover table-responsive ">
            <thead class="thead-dark">
            <tr>
                <th>Наименование</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th>Сумма</th>
            </tr>
            </thead>
            <tbody class="table-striped">
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><a href="<?=\yii\helpers\Url::to(['/product/view','id'=>$item->id])?>"><?=$item['name']?></td>
                    <td ><?=$item->qty_item?></td>
                    <td><?=$item->price?></td?>
                    <td><?=$item->sum_item?></td>
            <?php endforeach ?>


            </tbody>
        </table>
    </div>

</div>

