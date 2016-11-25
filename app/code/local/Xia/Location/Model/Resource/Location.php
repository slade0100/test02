<?php
class Xia_Location_Model_Resource_Location extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialize resource model
     * Get tablename from config
     *
     */
    protected function _construct()
    {
        $this->_init('location/location', 'id');
    }

    public function getNameById($id)
    {
        $adapter = $this->_getReadAdapter();
        $select = $adapter->select()
            ->from(
                $this->getMainTable(),
                array('name')
            )
            ->where('id = ?', $id);
//        echo $select->assemble();die();
        return $adapter->fetchOne($select);
    }
}
