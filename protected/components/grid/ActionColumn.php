<?php

namespace app\components\grid;

use kartik\icons\Icon;
use Yii;
use yii\bootstrap4\Html;
use yii\db\ActiveRecordInterface;
use yii\grid\ActionColumn as BaseActionColumn;
use yii\helpers\Url;

class ActionColumn extends BaseActionColumn
{
    public $headerOptions = [
        'class' => 'col-2'
    ];
    public $buttonOptions = [
        'class' => 'btn btn-sm btn-outline-info',
    ];

    /**
     * @param string $action
     * @param ActiveRecordInterface $model
     * @param mixed $key
     * @param int $index
     * @return mixed|string
     */
    public function createUrl($action, $model, $key, $index)
    {
        if (is_callable($this->urlCreator)) {
            return call_user_func($this->urlCreator, $action, $model, $key, $index, $this);
        }

        if ($action === 'viewOnSite') {
            return $model->url;
        }

        $params = is_array($key) ? $key : ['id' => (string)$key];
        $params[0] = $this->controller ? $this->controller . '/' . $action : $action;

        return Url::toRoute($params);
    }

    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view', 'eye');
        $this->initDefaultButton('update', 'pencil-alt');
        $this->initDefaultButton('delete', 'trash', [
            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
            'data-method' => 'post',
            'class' => ['btn-outline-danger'],
        ]);
        $this->initDefaultButton('viewOnSite', 'link', [
            'title' => Yii::t('app', 'View on site'),
            'target' => '_blank',
        ]);
        $this->initDefaultButton('restore', 'trash-restore', [
            'title' => Yii::t('app', 'Restore'),
            'data-confirm' => Yii::t('app', 'Restore?'),
            'data-method' => 'post',
        ]);
        $this->initDefaultButton('download', 'download', [
            'title' => Yii::t('app', 'Download'),
            'data-method' => 'post',
        ]);
    }

    /**
     * @param string $name
     * @param string $iconName
     * @param array $additionalOptions
     * @noinspection PhpUnusedParameterInspection
     */
    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'View');
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Delete');
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);

                if (!empty($additionalOptions['class'])) {
                    Html::addCssClass($options, $additionalOptions['class']);
                }
                $icon = Icon::show($iconName);
                return Html::a($icon, $url, $options);
            };
        }
    }
}
