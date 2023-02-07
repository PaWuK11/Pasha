<?php

namespace Pasha\AdminLog\Plugin;

use Magento\Store\Model\StoreManager;
use Pasha\AdminLog\Api\Data\AdminLogCmsPageDetailsInterfaceFactory;
use Pasha\AdminLog\Api\Data\AdminLogCmsPageInterfaceFactory;
use Pasha\AdminLog\Api\LogCmsPageDetailsRepositoryInterface;
use Pasha\AdminLog\Api\LogCmsPageRepositoryInterface;


class DeleteCmsPlugin
{
    private AdminLogCmsPageInterfaceFactory $modelFactory;
    private LogCmsPageRepositoryInterface $logRepository;
    private AdminLogCmsPageDetailsInterfaceFactory $modelDetailsFactory;
    private LogCmsPageDetailsRepositoryInterface $logRepositoryDetails;

    public function __construct(
        LogCmsPageDetailsRepositoryInterface $logRepositoryDetails,
        AdminLogCmsPageDetailsInterfaceFactory $modelDetailsFactory,
        AdminLogCmsPageInterfaceFactory $modelFactory,
        LogCmsPageRepositoryInterface $logRepository,
        \Magento\Backend\Model\Auth\Session $authSession,
        StoreManager $storeManager,
    ) {
        $this->logRepositoryDetails = $logRepositoryDetails;
        $this->modelDetailsFactory = $modelDetailsFactory;
        $this->modelFactory = $modelFactory;
        $this->logRepository = $logRepository;
        $this->authSession = $authSession;
        $this->storeManager = $storeManager;
    }

    public function aroundDelete(\Magento\Cms\Model\ResourceModel\Page $resourceModel, callable $proceed, $object) {
        try {
            $result = $proceed($object);
            $model = $this->modelFactory->create();
            $model->setObjectId($object->getId());
            $model->setName($object->getTitle());
            $model->setEntity('navigation');
            $model->setAction('deleted');
            $model->setStore($this->storeManager->getStore()->getName());
            $model->setUser($this->authSession->getUser()->getUsername());
            $this->logRepository->save($model);

            foreach ($object->getData() as $key => $value) {
                if ($object->getOrigData($key) != $object->getData($key)) {
                    $modelDetails = $this->modelDetailsFactory->create();
                    $modelDetails->setField($key);
                    $modelDetails->setOldData($object->getOrigData($key));
                    $modelDetails->setNewData($object->getData($key));
                    $modelDetails->setObjectId($object->getId());
                    $modelDetails->setParentId($model->getEntityId());

                    $this->logRepositoryDetails->save($modelDetails);
                }
            }
        }
        catch (\Exception $e) {

        }
        return $result;
    }
}
