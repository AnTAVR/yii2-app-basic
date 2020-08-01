<?php

namespace app\modules\statics\models;

use app\widgets\UrlTranslit\UrlTranslit;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class StaticPageSearch extends Model
{
    public $content_title;
    public $meta_url;

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
        ];
    }

    public function attributeLabels(): array
    {
        $model = new StaticPage();
        return $model->attributeLabels();
    }

    public function search(): ActiveDataProvider
    {
        $query = StaticPage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => Yii::$app->modules['statics']->params['adminPageSize'],
            ],
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC,],
            ],
        ]);
        $params = Yii::$app->request->getQueryParams();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['like', 'meta_url', $this->meta_url])
                ->andFilterWhere(['like', 'content_title', $this->content_title]);
        }

        return $dataProvider;
    }
}
