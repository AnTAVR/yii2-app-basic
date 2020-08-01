<?php

use app\migrations\DefaultContent;
use app\modules\news\models\News;
use app\modules\news\traits\IActiveNewsStatus;
use yii\db\Migration;

class m000002_000200_insert_news extends Migration
{
    public const CONTENT_TITLE = 'news';
    public const COUNT = 17;

    public $tableName;

    public function init(): void
    {
        parent::init();
        $this->tableName = News::tableName();
    }

    public function up()
    {
        $content_short = str_replace('{image}', DefaultContent::CONTENT_IMAGE, DefaultContent::CONTENT_SHORT);
        $content_full = str_replace(['{short}', '{full}'], [
            str_replace('{image}', '', DefaultContent::CONTENT_SHORT),
            $content_short,
        ], DefaultContent::CONTENT_FULL);

        $styles = [
            ' float-left',
            ' float-right',
            ' float-none',
        ];
        for ($i = 0; $i++ < self::COUNT;) {
            $title = self::CONTENT_TITLE . $i;
            $style = $styles[array_rand($styles)];
            $this->insert($this->tableName, [
                'published_at' => time(),
                'status' => IActiveNewsStatus::ACTIVE,

                'content_title' => $title,
                'content_short' => str_replace('{float}', $style, $content_short),
                'content_full' => str_replace(['{title}', '{float}'], [$title, $style], $content_full),

                'meta_url' => $title,
            ]);
        }
    }

    public function down()
    {
        for ($i = 0; $i++ < self::COUNT;) {
            $title = self::CONTENT_TITLE . $i;
            $this->delete($this->tableName, ['meta_url' => $title]);
        }
    }
}
