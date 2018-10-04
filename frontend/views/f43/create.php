<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\F43 */

$this->title = 'Create F43';
$this->params['breadcrumbs'][] = ['label' => 'F43s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="f43-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
