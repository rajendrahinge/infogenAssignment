<?php

namespace app\models;
use app\models\Project;

use Yii;

/**
 * This is the model class for table "teams".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $project_assigned
 * @property string $designation
 * @property string $created_time
 */
class Teams extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teams';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'designation'], 'required'], // , 'project_assigned'
            [['project_assigned'], 'integer'],
            [['created_time'], 'safe'],
            [['name', 'email', 'designation'], 'string', 'max' => 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'project_assigned' => 'Project Assigned',
            'designation' => 'Designation',
            'created_time' => 'Created Time',
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProjectassigned()
    {
       return $this->hasMany(Project::className(), ['id' => 'project_assigned']);
    }
    
}
