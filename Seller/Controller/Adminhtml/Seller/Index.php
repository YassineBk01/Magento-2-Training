<?php
declare(strict_types=1);

namespace Training\Seller\Controller\Adminhtml\Seller;

use Magento\Backend\Model\View\Result\Page as PageResult;
use Magento\Framework\Controller\ResultFactory;

/**
 * Seller grid action.
 */
class Index extends AbstractAction
{
    /**
     * @inheritdoc
     */
    public function execute()
    {
        $breadMain = __('Manage Sellers');

        /** @var PageResult $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
       /* $result->setActiveMenu('Training_Seller::config');
        $result->getConfig()->getTitle()->prepend($breadMain);*/

        return $result;
    }
}
