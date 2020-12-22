<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Teams;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); 

    // echo '<pre>';print_r(ArrayHelper::map(Teams::findAll(['designation' => '1']), 'id', 'name'));echo '</pre>';exit;
    ?>

    <?= $form->field($model, 'project_name')->textInput(['maxlength' => true]) ?>

    <!-- $form->field($model, 'status')->textInput() -->
    <?= 
        $form->field($model, 'status')->dropDownList(['Pending','Completed'],['prompt'=>'Select status','id'=>'status'])->label('Status');
     ?>

    <?= $form->field($model, 'team_size')->textInput() ?>

    <?php // $form->field($model, 'manager')->textInput()
        $mangerList = ArrayHelper::map(Teams::findAll(['designation' => '1']), 'id', 'name');
     ?>

    <?= 
        $form->field($model, 'manager')->dropDownList($mangerList,['prompt'=>'Select Manager','id'=>'manager'])->label('Manager');
    ?>

    <?php // $form->field($model, 'created_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
