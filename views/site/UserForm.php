<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name')->label('Your Name'); ?>
<?= $form->field($model, 'email')->label('Your Email'); ?>

<?= Html::submitButton('Submit',['class'=>'btn btn-success']); ?>

<?php $form = ActiveForm::end(); ?>