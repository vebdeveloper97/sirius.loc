<?php

use app\modules\users\models\Users;

/* @var $form \yii\bootstrap\ActiveForm */
/* @var $model \app\modules\users\models\Users */

Users::getPasswordUnset($model);
?>

<?= $form->field($model, 'old_password')->passwordInput(['autocomplete' => 'off']) ?>
<?= $form->field($model, 'password')->passwordInput(['autocomplete' => 'off']) ?>
<?= $form->field($model, 'repeat_password')->passwordInput(['autocomplete' => 'off']) ?>

