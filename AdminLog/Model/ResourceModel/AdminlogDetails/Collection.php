<?php

namespace Pasha\AdminLog\Model\ResourceModel\AdminlogDetails;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Pasha\AdminLog\Model\AdminLogDetailsModel;
use Pasha\AdminLog\Model\ResourceModel\AdminlogDetails;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(AdminLogDetailsModel::class, AdminlogDetails::class);
    }
}
