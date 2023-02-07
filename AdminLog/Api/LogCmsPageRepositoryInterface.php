<?php

namespace Pasha\AdminLog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Pasha\AdminLog\Api\Data\AdminLogCmsPageInterface;

interface LogCmsPageRepositoryInterface
{
    public function getById($id);

    public function save(AdminLogCmsPageInterface $save);

    public function delete(AdminLogCmsPageInterface $delete);

    public function getList(SearchCriteriaInterface $searchCriteria);
}
