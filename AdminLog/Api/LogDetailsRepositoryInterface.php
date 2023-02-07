<?php

namespace Pasha\AdminLog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Pasha\AdminLog\Api\Data\AdminLogDetailsInterface;

interface LogDetailsRepositoryInterface
{
    public function getById($id);

    public function save(AdminLogDetailsInterface $save);

    public function delete(AdminLogDetailsInterface $delete);

    public function getList(SearchCriteriaInterface $searchCriteria);
}
