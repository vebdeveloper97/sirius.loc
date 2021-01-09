<?php
/* @var $form \yii\bootstrap\ActiveForm */
/* @var $model \app\modules\users\models\Users */
unset($model->password);
?>

<?= $form->field($model, 'old_password')->passwordInput() ?>
<?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
<?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => true]) ?>

