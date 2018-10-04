<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\F43 */

$this->title = 'Update F43: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'F43s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->HOSPCODE, 'url' => ['view', 'id' => $model->HOSPCODE]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="f43-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
