<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\hr\models\HrEmployee */
/* @var $position \app\modules\hr\models\HrPosition*/
/* @var $hrposition \app\modules\hr\models\HrPositionCon*/
/* @var $works \app\modules\hr\models\Works*/
/* @var $hruser \app\modules\hr\models\HrUser*/

$this->title = Yii::t('app', 'Create Hr Employee');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hr Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-employee-create">

    <h4><?=Html::encode($this->title)?></h4>

    <?= $this->render('_form', [
        'model'      => $model,
        'position'   => $position,
        'hruser'     => $hruser,
        'works'      => $works,
        'hrposition' => $hrposition
    ]) ?>

</div>
