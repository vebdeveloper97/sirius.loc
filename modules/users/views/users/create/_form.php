<?php
    /* @var $form \yii\bootstrap\ActiveForm */
    /* @var $model \app\modules\users\models\Users */
?>

<?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>