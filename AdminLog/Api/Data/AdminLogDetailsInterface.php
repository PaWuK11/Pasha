<?php

namespace Pasha\AdminLog\Api\Data;

interface AdminLogDetailsInterface
{
    const ENTITY_ID = 'entity_id';
    const PARENT_ID = 'parent_id';
    const FIELD = 'field';
    const OLD_DATA = 'old_data';
    const NEW_DATA = 'new_data';
    const OBJECT_ID = 'object_id';

    public function getEntityId();
    public function setEntityId($id);

    public function getParentId();
    public function setParentId($id);

    public function getField();
    public function setField($field);

    public function getOldData();
    public function setOldData($data);

    public function getNewData();
    public function setNewData($data);

    public function getObjectId();
    public function setObjectId($id);
}
