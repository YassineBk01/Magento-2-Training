<?php

namespace Training\AdminLogs\Controller\Adminhtml\UserAction;

use Magento\Backend\App\Action;

use Magento\Backend\App\Action\Context;
use Training\AdminLogs\Model\ResourceModel\UserAction\CollectionFactory;

class DeleteUserAction extends Action
{

    const ADMIN_RESOURCE = 'Training_AdminLogs::deleteAction';

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
        if (!is_array($ids)) {
            $this->messageManager->addError(__('Please select item(s) to delete.'));
        } else {
            try {
                $collection = $this->collectionFactory->create();
                $collection->addFieldToFilter('id', ['in' => $ids]);

                foreach ($collection as $item) {
                    $item->delete();
                }

                $this->messageManager->addSuccess(__('Items have been permanently deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addError(__('An error occurred while deleting items: %1', $e->getMessage()));
            }
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('useraction/index/index');
        return $resultRedirect;
    }
}
