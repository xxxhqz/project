<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php
    $form = ActiveForm::begin();

   echo $form->field($model, 'name')->label('Your Name');
   echo $form->field($model, 'email')->label('Your Email');
?>

<div class="form-group">
    <?= Html::submitButton('Submit',['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>