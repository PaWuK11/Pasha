<?php

namespace Pasha\AdminLog\Model;

use Magento\Framework\Model\AbstractModel;
use Pasha\AdminLog\Api\Data\AdminLogCmsPageDetailsInterface;
use Pasha\AdminLog\Api\Data\AdminLogCmsPageInterface;
use Pasha\AdminLog\Model\ResourceModel\AdminLogCmsPageDetails;
use Pasha\AdminLog\Model\ResourceModel\AdminlogDetails;

class AdminLogCmsPageDetailsModel extends AbstractModel implements AdminLogCmsPageDetailsInterface
{
    public function getParentId()
    {
        return $this->getData(self::PARENT_ID);
    }
    public function setParentId($id)
    {
        return $this->setData(self::PARENT_ID, $id);
    }
    public function getField()
    {
        return $this->getData(self::FIELD);
    }
    public function setField($field)
    {
        return $this->setData(self::FIELD, $field);
    }
    public function getOldData()
    {
        return $this->getData(self::OLD_DATA);
    }
    public function setOldData($data)
    {
        return $this->setData(self::OLD_DATA, $data);
    }
    public function getNewData()
    {
        return $this->getData(self::NEW_DATA);
    }
    public function setNewData($data)
    {
        return $this->setData(self::NEW_DATA, $data);
    }
    public function getObjectId()
    {
        return $this->getData(self::OBJECT_ID);
    }
    public function setObjectId($id)
    {
        return $this->setData(self::OBJECT_ID, $id);
    }
    public function _construct()
    {
        $this->_init(AdminLogCmsPageDetails::class);
    }
}
