<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Logupload */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="logupload-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hospcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hosname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ampurname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'upload_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_size')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
