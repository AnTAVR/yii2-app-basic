<?php

use app\migrations\AdminPanelMigration;

class m000002_000300_news_admin_rbac extends AdminPanelMigration
{
    public const PERMISSION_ADMIN = 'news.openAdminPanel';
}
