<?php

namespace Pasha\AdminLog\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Pasha\AdminLog\Api\Data\AdminLogCmsPageInterface;
use Pasha\AdminLog\Api\LogCmsPageRepositoryInterface;
use Pasha\AdminLog\Model\ResourceModel\AdminLogCmsPage;

class CmsLogRepository implements LogCmsPageRepositoryInterface
{
    private AdminLogCmsPage $adminLogCmsPage;

    public function __construct(
        AdminLogCmsPage $adminLogCmsPage
    )
    {
        $this->adminLogCmsPage = $adminLogCmsPage;
    }

    public function getById($id)
    {
        $adminlogs = $this->adminLogsCmsPageFactory->create();
        $this->adminLogCmsPage->load($adminlogs, $id);
        if (! $this->adminLogCmsPage->getId()) {
            throw new NoSuchEntityException(__('Unable to find amasty with ID "%1"', $id));
        }
        return $adminlogs;
    }

    public function save(AdminLogCmsPageInterface $save)
    {
        return $this->adminLogCmsPage->save($save);
    }

    public function delete(AdminLogCmsPageInterface $delete)
    {
        $this->adminLogCmsPage->delete($delete);
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
