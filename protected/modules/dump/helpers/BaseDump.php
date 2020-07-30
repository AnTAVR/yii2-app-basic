<?php

namespace app\modules\dump\helpers;

use Yii;
use yii\base\Exception as YiiException;
use yii\base\InvalidConfigException;
use yii\db\Connection;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\StringHelper;
use yii\web\HttpException;

class BaseDump
{
    public const PATH_DB = 'db';

    /**
     * @param string $dbName
     * @return string
     * @throws YiiException
     */
    public static function makePath($dbName): string
    {
        return static::getPath() . DIRECTORY_SEPARATOR . sprintf('%s_%s.%s',
                $dbName,
                date('Y-m-d_H-i-s'),
                'sql.gz'
            );
    }

    /**
     * @return string
     * @throws YiiException
     */
    public static function getPath(): string
    {
        $path = Yii::getAlias('@backups') . DIRECTORY_SEPARATOR . static::PATH_DB;
        if (!is_dir($path)) {
            FileHelper::createDirectory($path, 0775, true);
        }
        return $path;
    }

    /**
     * @return array
     * @throws YiiException
     */
    public static function getFilesList(): array
    {
        $files = FileHelper::findFiles(static::getPath(), ['only' => ['*.sql', '*.gz']]);
        $fileList = [];
        foreach ($files as $file) {
            $basename = StringHelper::basename($file);
            $fileList[$basename] = [
                'file' => $basename,
                'created_at' => filectime($file),
            ];
        }
        ArrayHelper::multisort($fileList, ['file'], [SORT_DESC]);
        return $fileList;
    }

    /**
     * @param string $dbName
     * @return array
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public static function getDbInfo($dbName = 'db'): array
    {
        $dbInfo = [];

        $db = Instance::ensure($dbName, Connection::class);

        $dbInfo['driverName'] = $db->driverName;
        $dbInfo['dsn'] = $db->dsn;
        $dbInfo['host'] = static::getDsnAttribute('host', $db->dsn);
        $dbInfo['port'] = static::getDsnAttribute('port', $db->dsn);
        $dbInfo['dbName'] = static::getDsnAttribute('dbname', $db->dsn);
        $dbInfo['username'] = $db->username;
        $dbInfo['password'] = $db->password;
        $dbInfo['prefix'] = $db->tablePrefix;

        if ($dbInfo['driverName'] === 'mysql') {
            $port = '3306';
            $dbInfo['manager'] = new MysqlDump();
        } elseif ($dbInfo['driverName'] === 'pgsql') {
            $port = '5432';
            $dbInfo['manager'] = new PostgresDump();
        } else {
            throw new HttpException($dbInfo['driverName'] . ' driver unsupported!');
        }
        if (!$dbInfo['port']) {
            $dbInfo['port'] = $port;
        }

        return $dbInfo;
    }

    /**
     * @param string $name
     * @param string $dsn
     * @return string | null
     */
    protected static function getDsnAttribute($name, $dsn): ?string
    {
        if (preg_match('/' . $name . '=([^;]*)/', $dsn, $match)) {
            return $match[1];
        }
        return null;
    }
}
