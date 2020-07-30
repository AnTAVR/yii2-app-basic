<?php

use app\migrations\AdminPanelMigration;

class m000001_001900_dump_admin_rbac extends AdminPanelMigration
{
    public const PERMISSION_ADMIN = 'dump.openAdminPanel';
}
