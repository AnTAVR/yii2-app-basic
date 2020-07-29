<?php

use app\migrations\AdminPanelMigration;

class m000001_000900_rbac_admin_rbac extends AdminPanelMigration
{
    public const PERMISSION_ADMIN = 'rbac.openAdminPanel';
}
