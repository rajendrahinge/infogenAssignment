<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\Project;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeamsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teams-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Teams', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'email:email',[
            'attribute' => 'project_assigned',
            'filter' => ArrayHelper::map(Project::find()->where(["status" => 0])->asArray()->all(), 'id', 'project_name'),
            'value' => function($model) {
                return empty($model->projectassigned) ? '-' : $model->projectassigned[0]->project_name;
            }],
            [                
            'attribute'=>'designation',
            'filter' => ["Manager","Employee"],
            'value' => function($model) {
                return ($model->designation == 0) ? "Employee" : "Manager";
            }],
            // 'designation',
            //'created_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
