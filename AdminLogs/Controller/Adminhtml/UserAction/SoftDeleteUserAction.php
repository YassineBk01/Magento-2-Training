<?php

namespace Training\AdminLogs\Controller\Adminhtml\UserAction;

use Magento\Backend\App\Action;

use Magento\Backend\App\Action\Context;
use Training\AdminLogs\Model\ResourceModel\UserAction\CollectionFactory;

class SoftDeleteUserAction extends Action
{

    private $collectionFactory;

    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }



    public function execute()
    {
        $ids = $this->getRequest()->getParam('selected');

        try {
            $collection = $this->collectionFactory->create();
            $collection->addFieldToFilter('id', ['in' => $ids]);
            foreach ($collection as $item) {
                // Set the desired fields to true
                $item->setData('is_deleted', true);
                $item->save();
            }
            $this->messageManager->addSuccessMessage(__('Selected items have been updated.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An error occurred while updating items: %1', $e->getMessage()));
        }

        return $this->_redirect('useraction/index/index');
    }
}
