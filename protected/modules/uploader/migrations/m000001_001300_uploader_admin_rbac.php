<?php

use app\migrations\AdminPanelMigration;

class m000001_001300_uploader_admin_rbac extends AdminPanelMigration
{
    public const PERMISSION_ADMIN = 'uploader.openAdminPanel';
}
