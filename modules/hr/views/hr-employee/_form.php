<?php

use app\components\TabularInput\CustomTabularInput;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\hr\models\HrEmployee */
/* @var $form yii\widgets\ActiveForm */
/* @var $position \app\modules\hr\models\HrPosition*/
/* @var $hrposition \app\modules\hr\models\HrPositionCon*/
/* @var $works \app\modules\hr\models\Works*/
/* @var $hruser \app\modules\hr\models\HrUser*/

?>

<div class="hr-employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="head_block">
        <div class="row">
            <div class="col-sm-3">
                <?= $form->field($model, 'fish')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'images')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <?= $form->field($model, 'files')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'pasport_seria')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-3">
            </div>
        </div>
    </div>

    <div class="works">
        <?php
        try {
            echo CustomTabularInput::widget([
                'min'               => 1,
                'allowEmptyList'    => false,
                'addButtonPosition' => MultipleInput::POS_HEADER,
                'form' => $form,
                'models' => $works,
                'addButtonOptions' => [
                    'class' => 'btn btn-success',
                ],
                'columns' => [
                    [
                        'name' => 'name',
                        'title' => Yii::t('app', 'Work name'),
                        'options' => [
                            'class' => 'input-priority'
                        ]
                    ],
                    [
                        'name' => 'year_start',
                        'title' => Yii::t('app', 'Start date'),
                        'type' => DatePicker::class,
                        'options' => [
                            'pluginOptions' => [
                                'format' => 'dd.mm.yyyy',
                                'todayHighlight' => true
                            ]
                        ]

                    ],
                    [
                        'name' => 'year_end',
                        'title' => Yii::t('app', 'End date'),
                        'type' => DatePicker::class,
                        'options' => [
                            'pluginOptions' => [
                                'format' => 'dd.mm.yyyy',
                                'todayHighlight' => true
                            ]
                        ]

                    ],
                    [
                        'name' => 'info',
                        'title' => Yii::t('app', 'Info'),

                    ],
                    [
                        'name' => 'files'

                    ]
                ]
            ]);


        } catch (Exception $e) {
        }
        ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
