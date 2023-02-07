<?php

namespace Pasha\AdminLog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class AdminlogDetails extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('details', 'entity_id');
    }
}
