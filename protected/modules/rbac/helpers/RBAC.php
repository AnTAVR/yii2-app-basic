<?php

namespace app\modules\rbac\helpers;

use Exception;
use Yii;
use yii\rbac\Role;

class RBAC
{
    public const ADMIN_PERMISSION = 'admin.openAdminPanel';
    public const ADMIN_ROLE = 'admin-role';

    /**
     * @param string $name
     * @param integer|array $userId
     * @param string|null $description
     * @return Role
     * @throws Exception
     */
    public static function createRole($name, $userId, $description = null): Role
    {
        $auth = Yii::$app->authManager;

        $role = $auth->createRole($name);
        $role->description = $description;
        $auth->add($role);

        if (!is_array($userId)) {
            $userId = [$userId];
        }

        foreach ($userId as $id) {
            $auth->assign($role, $id);
        }

        return $role;
    }

    public static function name2description($name): string
    {
        $label = strtolower(trim(str_replace([
            '-',
            '_',
            '.',
        ], ' ', preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $name))));

        return ucfirst(strtolower($label));
    }
}