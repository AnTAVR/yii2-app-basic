<?php

namespace app\modules\products\models;

use app\modules\products\traits\ProductsStatusTrait;
use app\widgets\UrlTranslit\UrlTranslit;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ProductSearch extends Model
{
    public $meta_url;
    public $content_title;
    public $status;
    public $category_id;

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
            ['status', 'in', 'range' => ProductsStatusTrait::getStatusRange()],

            ['category_id', 'integer'],
            ['category_id', 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        $model = new Products();
        return $model->attributeLabels();
    }

    public function search(): ActiveDataProvider
    {
        $query = Products::find();
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
            ->andFilterWhere(['category_id' => $this->category_id])
            ->andFilterWhere(['status' => $this->status]);

        return $dataProvider;
    }
}
