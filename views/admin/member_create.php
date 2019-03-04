<?php

$status = array(
    '' => 'Select',
    '1' => 'Yes',
    '2' => 'No'
);

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create New Member';
// $this->params['breadcrumbs'][] = ['label' => 'Admin Dashboard', 'url' => ['/admin/dashboard']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/admin">Admin Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=$this->title?></li>
  </ol>
</nav>

<div class="posts-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="posts-form">
    <?php $form = ActiveForm::begin(); $model->status = 2; ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'address')->textarea(['rows' => 2]) ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <!-- set as default '2' for new comers -->
        <?php $form->field($model, 'status')->dropDownList($status)  ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

    </div>

</div>
