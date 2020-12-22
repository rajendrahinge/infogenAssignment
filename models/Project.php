<?php

namespace app\models;
use app\models\Teams;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $project_name
 * @property int $status 0 = pending, 1 = complete
 * @property int $team_size
 * @property int $manager
 * @property string $created_time
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_name', 'status', 'team_size', 'manager'], 'required'], // , 'created_time'
            [['status', 'team_size', 'manager'], 'integer'],
            [['created_time'], 'safe'],
            [['project_name'], 'string', 'max' => 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_name' => 'Project Name',
            'status' => 'Status',
            'team_size' => 'Team Size',
            'manager' => 'Manager',
            'created_time' => 'Created Time',
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getManagersname()
    {
        // echo '<pre>';print_r($this->hasMany(Teams::className(), ['manager' => 'id']));echo '</pre>';exit;
       return $this->hasMany(Teams::className(), ['id' => 'manager']);
    }
}
