<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\LogUploadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="logupload-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'hospcode') ?>

    <?= $form->field($model, 'hosname') ?>

    <?= $form->field($model, 'ampurname') ?>

    <?= $form->field($model, 'upload_date') ?>

    <?php // echo $form->field($model, 'file_size') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
