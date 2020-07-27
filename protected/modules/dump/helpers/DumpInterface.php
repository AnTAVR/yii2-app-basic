<?php

namespace app\modules\dump\helpers;

abstract class DumpInterface
{

    /**
     * @param string $dumpFile
     * @param array $dbInfo
     * @return array
     */
    abstract public static function makeDumpCommand($dumpFile, $dbInfo);

    /**
     * @param string $dumpFile
     * @param array $dbInfo
     * @return array
     */
    abstract public static function makeRestoreCommand($dumpFile, $dbInfo);

    /**
     * @return bool
     */
    public static function isWindows()
    {
        return stripos(PHP_OS, 'WIN');
    }
}