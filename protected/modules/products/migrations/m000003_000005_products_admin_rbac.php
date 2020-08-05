<?php

use app\migrations\AdminPanelMigration;

class m000003_000005_products_admin_rbac extends AdminPanelMigration
{
    public const PERMISSION_ADMIN = 'products.openAdminPanel';
}
