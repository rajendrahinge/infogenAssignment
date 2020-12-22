<?php

namespace app\models;
use app\models\Teams;
use app\models\Project;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int $team_id
 * @property int $project_id
 * @property string $work_details
 * @property int $time_spent
 * @property string $created_time
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['team_id', 'project_id', 'work_details', 'time_spent'], 'required'],
            [['team_id', 'project_id', 'time_spent'], 'integer'],
            [['work_details'], 'string'],
            [['created_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'team_id' => 'Member Name',
            'project_id' => 'Project Name',
            'work_details' => 'Work Details',
            'time_spent' => 'Time Spent',
            'created_time' => 'Created Time',
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProjectassigned()
    {
       return $this->hasMany(Project::className(), ['id' => 'project_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getManagersname()
    {
        echo '<pre>';print_r($this->hasMany(Teams::className(), ['manager' => 'id']));echo '</pre>';exit;
       return $this->hasMany(Teams::className(), ['id' => 'team_id']);
    }
}
