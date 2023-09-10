<?php

namespace Training\AdminLogs\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
