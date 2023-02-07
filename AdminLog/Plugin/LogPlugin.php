<?php

namespace Pasha\AdminLog\Plugin;

use Magento\Store\Model\StoreManager;
use Pasha\AdminLog\Api\Data\AdminLogDetailsInterfaceFactory;
use Pasha\AdminLog\Api\Data\AdminLogInterfaceFactory;
use Pasha\AdminLog\Api\LogDetailsRepositoryInterface;
use Pasha\AdminLog\Api\LogRepositoryInterface;
use Magento\Catalog\Model\CategoryRepository;

class LogPlugin
{
    private AdminLogInterfaceFactory $modelFactory;
    private AdminLogDetailsInterfaceFactory $modelDetailsFactory;
    private LogRepositoryInterface $logRepository;
    private LogDetailsRepositoryInterface $logRepositoryDetails;

    private CategoryRepository $categoryRepository;

    public function __construct(
        LogDetailsRepositoryInterface $logRepositoryDetails,
        AdminLogDetailsInterfaceFactory $modelDetailsFactory,
        AdminLogInterfaceFactory $modelFactory,
        LogRepositoryInterface $logRepository,
        \Magento\Backend\Model\Auth\Session $authSession,
        StoreManager $storeManager,
        CategoryRepository $categoryRepository,
    ) {
        $this->logRepositoryDetails = $logRepositoryDetails;
        $this->modelDetailsFactory = $modelDetailsFactory;
        $this->categoryRepository = $categoryRepository;
        $this->modelFactory = $modelFactory;
        $this->logRepository = $logRepository;
        $this->authSession = $authSession;
        $this->storeManager = $storeManager;
    }
    public function aroundSave(\Magento\Catalog\Model\ResourceModel\Category $resourceModel, callable $proceed, $object)
    {
    try {
        if ($object->getId() != "") {
            $category = $this->categoryRepository->get($object->getId());
            $result = $proceed($object);
            $model = $this->modelFactory->create();
            $modelDetails = $this->modelDetailsFactory->create();
            $model->setObjectId($object->getId());
            $model->setName($object->getName());
            $model->setEntity('navigation');
            $model->setCreatedAt($object->getCreatedAt());
            $model->setAction('update');
            $model->setStore($this->storeManager->getStore()->getName());
            $model->setUser($this->authSession->getUser()->getUsername());
            $this->logRepository->save($model);

            foreach ($category->getData() as $key => $value) {
                if ($category->getData($key) != $object->getData($key)) {
                    $modelDetails = $this->modelDetailsFactory->create();
                    $modelDetails->setField($key);
                    $modelDetails->setOldData($category->getData($key));
                    $modelDetails->setNewData($object->getData($key));
                    $modelDetails->setObjectId($object->getId());
                    $modelDetails->setParentId($model->getEntityId());

                    $this->logRepositoryDetails->save($modelDetails);
                }
            }
        }
        else
        {
            $result = $proceed($object);
            $model = $this->modelFactory->create();
            $modelDetails = $this->modelDetailsFactory->create();
            $model->setObjectId($object->getId());
            $model->setName($object->getName());
            $model->setEntity('navigation');
            $model->setCreatedAt($object->getCreatedAt());
            $model->setAction('created');
            $model->setStore($this->storeManager->getStore()->getName());
            $model->setUser($this->authSession->getUser()->getUsername());
            $this->logRepository->save($model);

            foreach ($object->getData() as $key => $value) {
                if (!is_array($value)) {
                    $modelDetails = $this->modelDetailsFactory->create();
                    $modelDetails->setField($key);
                    $modelDetails->setNewData($object->getData($key));
                    $modelDetails->setObjectId($object->getId());
                    $modelDetails->setParentId($model->getEntityId());

                    $this->logRepositoryDetails->save($modelDetails);
                }
            }
        }
        } catch (\Exception $e) {

        }
        return $resourceModel;
    }
}
