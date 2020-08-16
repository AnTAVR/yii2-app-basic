<?php

namespace app\modules\products\models;

use app\modules\products\traits\CategoryTypeTrait;
use app\widgets\UrlTranslit\UrlTranslit;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CategorySearch extends Model
{
    public $meta_url;
    public $content_title;
    public $type;

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

            ['type', 'integer'],
            ['type', 'in', 'range' => CategoryTypeTrait::getTypeRange()],
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
            ->andFilterWhere(['like', 'content_title', $this->content_title])
            ->andFilterWhere(['type' => $this->type]);

        return $dataProvider;
    }
}
