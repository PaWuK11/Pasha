<?php

namespace Pasha\AdminLog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Pasha\AdminLog\Api\Data\AdminLogCmsPageDetailsInterface;

interface LogCmsPageDetailsRepositoryInterface
{
    public function getById($id);

    public function save(AdminLogCmsPageDetailsInterface $save);

    public function delete(AdminLogCmsPageDetailsInterface $delete);

    public function getList(SearchCriteriaInterface $searchCriteria);
}
