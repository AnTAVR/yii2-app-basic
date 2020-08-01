<?php

namespace app\modules\news\models;

use app\modules\news\traits\NewsStatusTrait;
use app\widgets\UrlTranslit\UrlTranslit;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class NewsSearch extends Model
{
    public $content_title;
    public $meta_url;
    public $status;

    public function rules(): array
    {
        $params = Yii::$app->params;
        return [
            ['content_title', 'string',
                'max' => $params['string.max']],

            ['meta_url', 'string',
                'max' => $params['string.max']],
            ['meta_url', 'match',
                'pattern' => UrlTranslit::PATTERN],

            ['status', 'integer'],
            ['status', 'in', 'range' => NewsStatusTrait::getStatusRange()],
        ];
    }

    public function attributeLabels(): array
    {
        $model = new News();
        return $model->attributeLabels();
    }

    public function search(): ActiveDataProvider
    {
        $query = News::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => Yii::$app->modules['news']->params['adminPageSize'],
            ],
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC,],
            ],
        ]);
        $params = Yii::$app->request->getQueryParams();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['like', 'meta_url', $this->meta_url])
                ->andFilterWhere(['like', 'content_title', $this->content_title])
                ->andFilterWhere(['status' => $this->status]);
        }

        return $dataProvider;
    }
}
