<?php

use app\modules\account\components\AdminPanelMigration;

class m000001_001700_uploader_admin_rbac extends AdminPanelMigration
{
    public const PERMISSION_ADMIN = 'uploader.openAdminPanel';
}
