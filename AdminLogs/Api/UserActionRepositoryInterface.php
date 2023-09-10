<?php

namespace Training\AdminLogs\Api;

use Training\AdminLogs\Api\Data\UserActionInterface;

interface UserActionRepositoryInterface
{
    /**
     * @return UserActionInterface[]
     */
    public function getList();
} 