<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);


/** @var yii\web\View $this */
/** @var app\modules\admin\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<!--//    --><?php //= $form->field($model, 'category_id')->textInput() ?>
   <!-- <div class="form-group field-product_category_id has-success">
        <label for="product_category_id" class="control-label">Родительская категория</label>
        <select name="Product[category_id]" id="product_category_id" class="form-control">
            <?php /*= \app\components\MenuWidget::widget(['tmp'=>'select_product','model'=>$model]) */?>
        </select>
    </div>-->

    <?php
    echo $form->field($model, 'content')->widget(CKEditor::className(), [
    'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
    ]);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?= $form->field($model, 'hit')->dropDownList([ '0'=>'нет', '1'=>'да', ]) ?>

    <?= $form->field($model, 'new')->dropDownList([ '0'=>'нет', '1'=>'да', ]) ?>

    <?= $form->field($model, 'sale')->dropDownList([ '0'=>'нет', '1'=>'да', ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
