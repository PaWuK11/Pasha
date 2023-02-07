<?php

namespace Pasha\AdminLog\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Adminlog extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('adminlog', 'entity_id');
    }

}
