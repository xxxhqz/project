<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Register as a New Member';
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=$this->title?></li>
  </ol>
</nav>

<div class="signup">

    <?php if (Yii::$app->session->hasFlash('successRegister')): ?>

    <div class="alert alert-success">
        You have successfully registered as a new member <a href="/login">Login now</a> ?
    </div>
    <?php else: ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="posts-form">
    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-md-5']]); $model->status = 2; ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'username')->textInput() ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'confirm_password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

    </div>
    <?php endif; ?>
</div>
