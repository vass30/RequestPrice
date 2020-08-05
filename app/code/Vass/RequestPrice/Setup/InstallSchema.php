<?php

namespace Vass\RequestPrice\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $tableName = $installer->getTable('price_request');
        if ($installer->getConnection()->isTableExists($tableName) != true) {
            $table = $installer->getConnection()
                ->newTable($tableName)

                ->addColumn('entity_id', Table::TYPE_INTEGER, null, [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true
                ], 'ID')

                ->addColumn('name', Table::TYPE_TEXT, null, [
                    'length' => 255,
                    'nullable' => false
                ], 'NAME')

                ->addColumn('email', Table::TYPE_TEXT, null, [
                    'length' => 255,
                    'nullable' => false
                ], 'EMAIL')
                ->addColumn('telephone', Table::TYPE_TEXT, null, [
                    'length' => 16,
                    'nullable' => true
                ], 'TELEPHONE')
                ->addColumn('comment', Table::TYPE_TEXT, null, [
                    'length' => 255,
                    'nullable' => true
                ], 'COMMENT')
                -> addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false ,
                     'default' => Table::TIMESTAMP_INIT],
                    'TIME CREATED'
                )
                ->addColumn('status', Table::TYPE_TEXT, null, [
                    'length' => 255,
                    'nullable' => true
                ], 'STATUS')
                ->addColumn('sku', Table::TYPE_TEXT, null, [
                    'length' => 255,
                    'nullable' => true
                ], 'SKU')
                -> addColumn(
                    'product_image',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'PRODUCT IMAGE'
                )

                ->setComment('Vass Request Price Table');
            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}
