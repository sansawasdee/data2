<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\F43 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="f43-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'HOSPCODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hosname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ampurname')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
