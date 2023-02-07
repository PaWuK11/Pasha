<?php

namespace Pasha\AdminLog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Pasha\AdminLog\Api\Data\AdminLogInterface;

interface LogRepositoryInterface
{
    public function getById($id);

    public function save(AdminLogInterface $save);

    public function delete(AdminLogInterface $delete);

    public function getList(SearchCriteriaInterface $searchCriteria);
}
