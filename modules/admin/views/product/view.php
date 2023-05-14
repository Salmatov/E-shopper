<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Хотите удалить товар?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'category_id',
            [
            'attribute'=>'category_id',
            'value'=>$model->category->name
            ],
            'name',
            'content:html',
            'price',
            'keywords',
            'description',
            'img',
            [
                'attribute'=>'hit',
                'value'=>function($data){
                    return !$data->hit ? '<span class="text-danger">Нет</span>':'<span class="text-success">Да</span>';
                },
                'format'=>'html'
            ],

            [
                'attribute'=>'new',
                'value'=>function($data){
                    return !$data->new ? '<span class="text-danger">Нет</span>':'<span class="text-success">Да</span>';
                },
                'format'=>'html'
            ],

            [
                'attribute'=>'sale',
                'value'=>function($data){
                    return !$data->sale ? '<span class="text-danger">Нет</span>':'<span class="text-success">Да</span>';
                },
                'format'=>'html'
            ],




            //'hit',
            //'new',
            //'sale',
        ],
    ]) ?>

</div>
