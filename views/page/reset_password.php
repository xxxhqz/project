<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\models\LoginForm */
$this->title = 'Reset Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->session->hasFlash('successResetPassword') && !empty($new_password)): ?>
        <div class="alert alert-success">
            Please copy this new password <b><?=$new_password?></b>
        </div>
    <?php else: ?>
    <p>Please fill out the following fields to reset password:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-form']); ?>
            <!-- <label>Username / Email</label> -->
                <?= $form->field($model, 'username') ?>
                <div class="form-group">
                    <?= Html::submitButton('Reset Password', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <?php endif; ?>
</div>

