<?php

use app\modules\account\components\AdminPanelMigration;

class m000001_000900_rbac_admin_rbac extends AdminPanelMigration
{
    const PERMISSION_ADMIN = 'rbac.openAdminPanel';
}
