<?php

namespace app\modules\dump\helpers;

use yii\helpers\StringHelper;

class MysqlDump extends DumpInterface
{
    /**
     * @param string $dumpFile
     * @param array $dbInfo
     * @return array
     */
    public static function makeDumpCommand($dumpFile, $dbInfo): array
    {
        return [
            'mysqldump',
            '--host=' . $dbInfo['host'],
            '--port=' . $dbInfo['port'],
            '--user=' . $dbInfo['username'],
            "--password='{$dbInfo['password']}'",
            $dbInfo['dbName'],
            '|',
            'gzip',
            '>',
            $dumpFile,
        ];
    }

    /**
     * @param string $dumpFile
     * @param array $dbInfo
     * @return array
     */
    public static function makeRestoreCommand($dumpFile, $dbInfo): array
    {
        $arguments = [];

        $endsWithGZ = StringHelper::endsWith($dumpFile, '.gz', false);

        if ($endsWithGZ) {
            $arguments[] = 'gunzip -c';
            $arguments[] = $dumpFile;
            $arguments[] = '|';
        }

        $arguments[] = 'mysql';
        $arguments[] = '--host=' . $dbInfo['host'];
        $arguments[] = '--port=' . $dbInfo['port'];
        $arguments[] = '--user=' . $dbInfo['username'];
        $arguments[] = "--password='{$dbInfo['password']}'";
        $arguments[] = $dbInfo['dbName'];

        if (!$endsWithGZ) {
            $arguments[] = '<';
            $arguments[] = $dumpFile;
        }

        return $arguments;
    }
}
