<?php

namespace Training\AdminLogs\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Training\AdminLogs\Model\ResourceModel\UserAction as ResourceModelUserAction;

class UserAction extends AbstractExtensibleModel {

    protected function _construct()
    {
        $this->_init(ResourceModelUserAction::class);
    }
}
