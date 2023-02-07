<?php

namespace Pasha\AdminLog\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Pasha\AdminLog\Api\Data\AdminLogInterface;
use Pasha\AdminLog\Api\LogRepositoryInterface;
use Pasha\AdminLog\Model\ResourceModel\Adminlog;

class LogRepository implements LogRepositoryInterface
{

    private Adminlog $adminlog;

    public function __construct(
        Adminlog $adminlog
    )
    {
        $this->adminlog = $adminlog;
    }

    public function getById($id)
    {
        $adminlogs = $this->adminlogsFactory->create();
        $this->adminlog->load($adminlogs, $id);
        if (! $this->adminlog->getId()) {
            throw new NoSuchEntityException(__('Unable to find amasty with ID "%1"', $id));
        }
        return $adminlogs;
    }

    public function save(AdminLogInterface $save)
    {
        return $this->adminlog->save($save);
    }

    public function delete(AdminLogInterface $delete)
    {
        $this->adminlog->delete($delete);
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }
}


