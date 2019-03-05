<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = 'Edit New Member';
$status = array(
    '' => 'Select',
    '1' => 'Active',
    '2' => 'Not Active'
);
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/admin">Admin Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/admin/member_list">Members List</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=$this->title?></li>
  </ol>
</nav>


<div class="posts-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="posts-form">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'address')->textarea(['rows' => 2]) ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'username')->textInput() ?>
        <?= $form->field($model, 'status')->dropDownList($status)  ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

    </div>

</div>
