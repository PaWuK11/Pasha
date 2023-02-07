<?php

namespace Pasha\AdminLog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class AdminLogCmsPage extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('cms_page_custom', 'entity_id');
    }
}
