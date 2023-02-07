<?php

namespace Pasha\AdminLog\Model\ResourceModel\Adminlog;



use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Pasha\AdminLog\Model\AdminlogModel;
use Pasha\AdminLog\Model\ResourceModel\Adminlog;

class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */

    public function _construct()
    {
        $this->_init(AdminlogModel::class, Adminlog::class);
    }
}
