<?php

namespace Pasha\AdminLog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class AdminLogCmsPageDetails extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('cms_page_custom_details', 'entity_id');
    }
}
