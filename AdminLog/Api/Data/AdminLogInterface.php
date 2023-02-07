<?php

namespace Pasha\AdminLog\Api\Data;

interface AdminLogInterface
{
    const ENTITY_ID = 'entity_id';
    const OBJECT_ID = 'object_id';
    const ENTITY = 'entity';
    const NAME = 'name';
    const USER = 'user';
    const CREATED_AT = 'created_at';
    const STORE = 'store';
    const ACTION = 'action';


    public function getEntityId();
    public function getObjectId();
    public function getEntity();
    public function getName();
    public function getUser();
    public function getCreatedAt();
    public function getStore();
    public function getAction();

    public function setObjectId($object_id);
    public function setEntity($entity);
    public function setName($name);
    public function setUser($user);
    public function setCreatedAt($created_at);
    public function setStore($store);
    public function setAction($action);
}
