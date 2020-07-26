<?php

use app\modules\account\components\AdminPanelMigration;

class m000001_001200_static_admin_rbac extends AdminPanelMigration
{
    const PERMISSION_ADMIN = 'statics.openAdminPanel';
}
