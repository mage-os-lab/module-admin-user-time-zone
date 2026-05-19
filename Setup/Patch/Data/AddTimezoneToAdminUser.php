<?php
declare(strict_types=1);

namespace Vendor\AdminTimezone\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class AddTimezoneToAdminUser implements DataPatchInterface
{
    public function __construct(
        private readonly ModuleDataSetupInterface $moduleDataSetup
    )
    {
    }

    public function apply(): void
    {
        $connection = $this->moduleDataSetup->getConnection();
        $table = $this->moduleDataSetup->getTable('admin_user');

        if (!$connection->tableColumnExists($table, 'timezone'))
            $connection->addColumn($table, 'timezone', [
                'type' => Table::TYPE_TEXT,
                'length' => 64,
                'nullable' => true,
                'default' => null,
                'comment' => 'Admin User Timezone',
            ]);
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }
}
