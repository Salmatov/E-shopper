<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\category $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin();  ?>

<!--    --><?php //= $form->field($model, 'parent_id')->textInput() ?>
    <div class="form-group field-category-parent_id has-success">
        <label for="category-parent_id" class="control-label">Родительская категория</label>
            <select name="Category[parent_id]" id="category-parent_id" class="form-control">
                <option value="0">Самостоятельная категория</option>
                <?= \app\components\MenuWidget::widget(['tmp'=>'select','model'=>$model]) ?>
            </select>
    </div>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
<!--        --><?php //= Html::submitButton($model->isNewRecord?'Create':'Update', ['class' => $model->isNewRecord? 'btn btn-success':'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
