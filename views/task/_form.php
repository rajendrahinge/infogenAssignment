<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Project;
use app\models\Teams;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">


    <?php $form = ActiveForm::begin(); ?>

    <?php $projectList = ArrayHelper::map(Project::findAll(['status' => '0']), 'id', 'project_name'); ?>

    <?= 
        $form->field($model, 'project_id')->dropDownList($projectList,['prompt'=>'Select Manager','id'=>'project_id'])->label('Project Assigned');
    ?>

    <?php $teamList = ArrayHelper::map(Teams::findAll(['designation' => '0']), 'id', 'name'); ?>

    <?= 
        $form->field($model, 'team_id')->dropDownList($teamList,['prompt'=>'Select Member','id'=>'team_id'])->label('Project Assigned');
    ?>

    <?= $form->field($model, 'work_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'time_spent')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
