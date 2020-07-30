<?php

use app\migrations\AdminPanelMigration;

class m000001_002200_articles_admin_rbac extends AdminPanelMigration
{
    public const PERMISSION_ADMIN = 'articles.openAdminPanel';
}
