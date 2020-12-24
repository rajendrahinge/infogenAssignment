<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\Teams;
use app\models\Project;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'header' => 'Sr.No',
                'class' => 'yii\grid\SerialColumn'
            ],
            [
                'header' => 'Team Member Name',
                'attribute' => 'team_id',
                'filter' => ArrayHelper::map(Teams::find()->where(["designation" => 0])->asArray()->all(), 'id', 'name'),
                'value' => function($model) {
                $currentMemberName = ArrayHelper::map(Teams::find()->where(["id" => $model->team_id])->asArray()->all(), 'id', 'name');
                return $currentMemberName[$model->team_id];
            }],
            [
                'header' => 'Work Details',
                'attribute' => 'work_details'
            ],
            [
                'attribute' => 'project_id',
                'filter' => ArrayHelper::map(Project::find()->where(["status" => 0])->asArray()->all(), 'id', 'project_name'),
                'value' => function($model) {
                    $currentProjectName = ArrayHelper::map(Project::find()->where(["id" => $model->project_id])->asArray()->all(), 'id', 'project_name');
                    // return $currentProjectName[$model->project_id];
                    return empty($currentProjectName[$model->project_id]) ? '-' : $currentProjectName[$model->project_id];
            }],
            [
                'header' => 'Time Spent',
                'attribute' => 'time_spent'
            ],
            // 'time_spent',
            //'created_time',
            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
