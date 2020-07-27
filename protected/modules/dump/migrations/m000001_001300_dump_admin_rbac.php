<?php

use app\modules\account\components\AdminPanelMigration;

class m000001_001300_dump_admin_rbac extends AdminPanelMigration
{
    public const PERMISSION_ADMIN = 'dump.openAdminPanel';
}
