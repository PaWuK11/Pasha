<?php

namespace Pasha\AdminLog\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Pasha\AdminLog\Api\Data\AdminLogCmsPageDetailsInterface;
use Pasha\AdminLog\Api\LogCmsPageDetailsRepositoryInterface;
use Pasha\AdminLog\Model\ResourceModel\AdminLogCmsPageDetails;

class CmsLogDetailsRepository implements LogCmsPageDetailsRepositoryInterface
{
    private AdminLogCmsPageDetails $adminlogDetails;
    private $collectionFactory;
    private $collectionProcessor;
    private $searchResultFactory;
    private $adminlogsDetailsFactory;

    public function __construct(
        AdminLogCmsPageDetails $adminlogDetails,
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

    public function save(AdminLogCmsPageDetailsInterface $save)
    {
        return $this->adminlogDetails->save($save);
    }

    public function delete(AdminLogCmsPageDetailsInterface $delete)
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
