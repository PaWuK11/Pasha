<?php

namespace Pasha\AdminLog\Model;

use Magento\Framework\Model\AbstractModel;
use Pasha\AdminLog\Api\Data\AdminLogCmsPageInterface;
use Pasha\AdminLog\Model\ResourceModel\AdminLogCmsPage;

class AdminLogCmsPageModel extends AbstractModel implements AdminLogCmsPageInterface
{
    public function setObjectId($object_id)
    {
        return $this->setData(self::OBJECT_ID, $object_id);
    }

    public function getObjectId()
    {
        return $this->getData(self::OBJECT_ID);
    }

    public function getStore()
    {
        return $this->getData(self::STORE);
    }

    public function getAction()
    {
        return $this->getData(self::ACTION);
    }

    public function setStore($store)
    {
        return $this->setData(self::STORE, $store);
    }

    public function setAction($action)
    {
        return $this->setData(self::ACTION, $action);
    }

    public function getEntity()
    {
        return $this->getData(self::ENTITY);
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function getUser()
    {
        return $this->getData(self::USER);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }
    public function setEntity($entity)
    {
        return $this->setData(self::ENTITY, $entity);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function setUser($user)
    {
        return $this->setData(self::USER, $user);
    }

    public function setCreatedAt($created_at)
    {
        return $this->setData(self::CREATED_AT, $created_at);
    }

    public function _construct()
    {
        $this->_init(AdminLogCmsPage::class);
    }

}
