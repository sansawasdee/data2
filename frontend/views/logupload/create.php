<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Logupload */

$this->title = 'Create Logupload';
$this->params['breadcrumbs'][] = ['label' => 'Loguploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logupload-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
