<?php

use app\migrations\DefaultContent;
use app\modules\statics\models\StaticPage;
use yii\db\Migration;

class m000001_001500_insert_statics extends Migration
{
    public $tableName;

    public $content_static = ['docs', 'history', 'priorities', 'partners', 'vacancy', 'conditions', 'resume', 'students', 'part-timers', 'about', 'rules', 'delivery', 'payment'];

    public function init(): void
    {
        parent::init();
        $this->tableName = StaticPage::tableName();
    }

    public function up()
    {
        $params = Yii::$app->params;

        $content_full = <<<HTML5
<div class="jumbotron">
    <h1>Congratulations!</h1>
    <p class="lead">You have successfully created your Yii-powered application.</p>
    <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
</div>
<div class="body-content">
    <div class="row">
        <div class="col-lg-4">
            <h2>Heading</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                dolore eu
                fugiat nulla pariatur.</p>
            <p><a class="btn btn-info" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <h2>Heading</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                dolore eu
                fugiat nulla pariatur.</p>
            <p><a class="btn btn-dark" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <h2>Heading</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                dolore eu
                fugiat nulla pariatur.</p>
            <p><a class="btn btn-light" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a>
            </p>
        </div>
    </div>
</div>
HTML5;
        $title = $params['brandLabel'];
        $this->insert($this->tableName, [
                'content_title' => $title,
                'content_full' => $content_full,
                'meta_url' => 'index',
            ]
        );

        $content_short = str_replace('{image}', DefaultContent::CONTENT_IMAGE, DefaultContent::CONTENT_SHORT);
        $content_full = str_replace(['{short}', '{full}'], [
            str_replace('{image}', '', DefaultContent::CONTENT_SHORT),
            $content_short,
        ], DefaultContent::CONTENT_FULL);

        foreach ($this->content_static as $title) {
            $this->insert($this->tableName, [
                    'content_title' => $title,
                    'content_full' => str_replace(['{title}', '{float}'], [$title, ' float-right'], $content_full),
                    'meta_url' => $title,
                ]
            );

        }
    }

    public function down()
    {
        foreach ($this->content_static as $title) {
            $this->delete($this->tableName, ['meta_url' => $title]);
        }
        $this->delete($this->tableName, ['meta_url' => 'index']);
    }
}
