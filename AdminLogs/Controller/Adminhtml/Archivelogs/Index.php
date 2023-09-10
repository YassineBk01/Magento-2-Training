<?php

namespace Training\AdminLogs\Controller\Adminhtml\Archivelogs;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Training\AdminLogs\Controller\Adminhtml\Archivelogs
 */
class Index extends Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->addBreadcrumb(__('Admin Logging'), __('Archive Logs'));
        $resultPage->getConfig()->getTitle()->prepend(__('Archive Logs'));

        return $resultPage;
    }
}
