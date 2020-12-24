<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Teams;
use app\models\Task;
// use app\models\Query;

/**
 * TeamsSearch represents the model behind the search form of `app\models\Teams`.
 */
class TeamsSearch extends Teams
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_assigned'], 'integer'],
            [['name', 'email', 'designation', 'created_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        // $query = Teams::find();
        $query = new \yii\db\Query();
        $query = $query->select(['sum(task.time_spent) as no_of_times','teams.name', 'teams.email', 'teams.project_assigned', 'teams.designation'])  
        ->from('teams')
        ->join('INNER JOIN','task','task.team_id = teams.id')
        ->join('INNER JOIN','project','project.id = task.project_id')
        ->where('project.status = 1')
        ->groupBy(['teams.id'])
        ->orderBy(['no_of_times' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'project_assigned' => $this->project_assigned,
            'created_time' => $this->created_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'designation', $this->designation]);

        return $dataProvider;
    }
}
