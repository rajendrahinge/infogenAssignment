<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Project;

/* @var $this yii\web\View */
/* @var $model app\models\Teams */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teams-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?php $projectList = ArrayHelper::map(Project::findAll(['status' => '0']), 'id', 'project_name'); ?>

    <?= 
        $form->field($model, 'project_assigned')->dropDownList($projectList,['prompt'=>'Select Manager','id'=>'project_assigned'])->label('Project Assigned');
    ?>

    <?= 
        $form->field($model, 'designation')->dropDownList(['Employee','Manager'],['prompt'=>'Select Type','id'=>'designation'])->label('Designation');
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
