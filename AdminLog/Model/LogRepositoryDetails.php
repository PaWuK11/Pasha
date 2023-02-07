<?php

namespace Pasha\AdminLog\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Pasha\AdminLog\Api\Data\AdminLogDetailsInterface;
use Pasha\AdminLog\Api\LogDetailsRepositoryInterface;
use Pasha\AdminLog\Model\ResourceModel\AdminlogDetails;

class LogRepositoryDetails implements LogDetailsRepositoryInterface
{
    private AdminLogDetails $adminlogDetails;
    private $collectionFactory;
    private $collectionProcessor;
    private $searchResultFactory;
    private $adminlogsDetailsFactory;

    public function __construct(
        AdminlogDetails $adminlogDetails,
        $collectionFactory,
        $collectionProcessor,
        $searchResultFactory,
        $adminlogsDetailsFactory
    )
    {
        $this->adminlogDetails = $adminlogDetails;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultFactory = $searchResultFactory;
        $this->adminlogsDetailsFactory = $adminlogsDetailsFactory;
    }

    public function getById($id)
    {
        $adminlogsDetails = $this->adminlogsDetailsFactory->create();
        $this->adminlogDetails->load($adminlogsDetails, $id);
        if (! $this->adminlogDetails->getId()) {
            throw new NoSuchEntityException(__('Unable to find amasty with ID "%1"', $id));
        }
        return $adminlogsDetails;
    }

    public function save(AdminLogDetailsInterface $save)
    {
        return $this->adminlogDetails->save($save);
    }

    public function delete(AdminLogDetailsInterface $delete)
    {
        $this->adminlogDetails->delete($delete);
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
