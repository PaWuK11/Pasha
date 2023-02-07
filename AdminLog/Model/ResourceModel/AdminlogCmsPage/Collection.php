<?php

namespace Pasha\AdminLog\Model\ResourceModel\AdminlogCmsPage;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Pasha\AdminLog\Model\AdminLogCmsPageModel;
use Pasha\AdminLog\Model\ResourceModel\AdminLogCmsPage;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(AdminLogCmsPageModel::class, AdminLogCmsPage::class);
    }
}
