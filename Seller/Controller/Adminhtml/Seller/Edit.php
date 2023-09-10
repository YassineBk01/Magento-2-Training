<?php
declare(strict_types=1);

namespace Training\Seller\Controller\Adminhtml\Seller;

use Magento\Backend\Model\View\Result\Page as PageResult;
use Magento\Framework\Controller\ResultFactory;

/**
 * Seller edit action.
 */
class Edit extends AbstractAction
{
    /**
     * @inheritdoc
     */
    public function execute()
    {
        $sellerId = (int) $this->getRequest()->getParam('seller_id');
        $seller = $this->initSeller($sellerId);

        /** @var PageResult $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $breadcrumbTitle = $seller->getSellerId() ? __('Edit Seller') : __('New Seller');

        $result->setActiveMenu('Training_Seller::manage')
            ->addBreadcrumb(__('Sellers'), __('Sellers'))
            ->addBreadcrumb($breadcrumbTitle, $breadcrumbTitle);

        $result->getConfig()->getTitle()->prepend(__('Manage Sellers'));
        $result->getConfig()->getTitle()->prepend(
            $seller->getSellerId()
                ? __("Edit Seller #%1", $seller->getIdentifier())
                : __('New Seller')
        );

        return $result;
    }
}
