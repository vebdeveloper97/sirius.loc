<?php

use app\models\BaseModel;
use app\modules\rbac\models\AuthAssignment;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rbac\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->widget(Select2::class,[
        'data' => AuthAssignment::getAuthItems(),
        'options' => [
            'placeholder' => Yii::t('app', 'Select'),
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ]
    ]) ?>

    <?= $form->field($model, 'user_id')->widget(Select2::class, [
        'data' => AuthAssignment::UsersSelects(),
        'language' => 'uz',
        'options' => [
            'placeholder' => Yii::t('app', 'Select'),
        ],
        'pluginOptions' => [
            'allowClear' => true
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
