<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/24
 * Time: 10:09
 */

$installer = $this;

$installer ->startSetup();

$table = $installer ->getConnection()
    ->newTable($installer->getTable('goods'))
    ->addColumn('id',Varien_Db_Ddl_Table::TYPE_INTEGER,null,array(
        'identity'=>true,
        'unsigned'=>true,
        'nullable'=>false,
        'primary'=>true,
    ),'Id')
    ->addColumn('name',Varien_Db_Ddl_Table::TYPE_VARCHAR,null,array(),'Name')
    ->addColumn('price',Varien_Db_Ddl_Table::TYPE_VARCHAR,null,array(),'Price')
    ->addColumn('data',Varien_Db_Ddl_Table::TYPE_DATE,null,array(),'Data');
$installer->getConnection()->createTable($table);
$installer->endSetup();