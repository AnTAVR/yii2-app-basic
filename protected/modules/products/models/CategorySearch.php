<?php

namespace app\modules\products\models;

use app\widgets\UrlTranslit\UrlTranslit;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CategorySearch extends Model
{
    public $meta_url;
    public $content_title;

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
        $model = new Category();
        return $model->attributeLabels();
    }

    public function search(): ActiveDataProvider
    {
        $query = Category::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => Yii::$app->modules['products']->params['adminPageSize'],
            ],
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC,],
            ],
        ]);
        $params = Yii::$app->request->getQueryParams();

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'meta_url', $this->meta_url])
            ->andFilterWhere(['like', 'content_title', $this->content_title]);

        return $dataProvider;
    }
}
