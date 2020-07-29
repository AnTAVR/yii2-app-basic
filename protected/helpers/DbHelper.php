<?php

namespace app\helpers;

use Yii;

class DbHelper
{
    public static function indexName($tableName, $key): string
    {
        $tableName = Yii::$app->db->quoteSql($tableName);
        $tableName = Yii::$app->db->schema->unquoteSimpleTableName($tableName);
        return 'ix_' . $tableName . '_' . $key;
//        return $tableName . '_' . $key . '_idx';
    }

    public static function foreignName($tableName, $key): string
    {
        $tableName = Yii::$app->db->quoteSql($tableName);
        $tableName = Yii::$app->db->schema->unquoteSimpleTableName($tableName);
        return $tableName . '_' . $key . '_fkey';
    }
}
