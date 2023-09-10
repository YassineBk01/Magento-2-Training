<?php

namespace Training\AdminLogs\Model;

use Training\AdminLogs\Api\UserActionRepositoryInterface;
use Training\AdminLogs\Model\ResourceModel\UserAction\CollectionFactory;

class UserActionRepository implements UserActionRepositoryInterface 
{
    private $collectionFactory;
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function getList()
    {
        return [];//$this->collectionFactory->create()->getItems();
    }
}
