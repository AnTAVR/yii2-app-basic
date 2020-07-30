<?php

namespace app\modules\dump\helpers;

abstract class DumpInterface
{
    /**
     * @param string $dumpFile
     * @param array $dbInfo
     * @return array
     */
    abstract public static function makeDumpCommand($dumpFile, $dbInfo): array;

    /**
     * @param string $dumpFile
     * @param array $dbInfo
     * @return array
     */
    abstract public static function makeRestoreCommand($dumpFile, $dbInfo): array;

    /**
     * @return bool
     */
    public static function isWindows(): bool
    {
        return stripos(PHP_OS, 'WIN');
    }
}
