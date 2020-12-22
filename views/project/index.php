<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\Teams;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 

    // echo '<pre>';print_r(ArrayHelper::map(Teams::find()->where(["designation" => 1])->asArray()->all(), 'id', 'name'));echo '</pre>';exit;
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'project_name',
            'team_size'
            ,[
            'attribute' => 'manager',
            'filter' => ArrayHelper::map(Teams::find()->where(["designation" => 1])->asArray()->all(), 'id', 'name'),
            'value' => function($model) {
                return $model->managersname[0]->name;
            }
            ],
            [                
            'attribute'=>'status',
            'filter' => ["Pending","Complete"],
            'value' => function($model) {
                return ($model->status == 0) ? "Pending" : "Complete";
            }   
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
