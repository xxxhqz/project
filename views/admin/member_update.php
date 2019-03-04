<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = 'Edit New Member';
$this->params['breadcrumbs'][] = ['label' => 'Member list', 'url' => ['admin/member_list']];
$this->params['breadcrumbs'][] = $this->title;

$status = array(
    '' => 'Select',
    '1' => 'Active',
    '2' => 'Not Active'
);
?>
<div class="posts-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="posts-form">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'address')->textarea(['rows' => 2]) ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'status')->dropDownList($status)  ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

    </div>

</div>
