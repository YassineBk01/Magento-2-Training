<?php
declare(strict_types=1);

namespace Training\Seller\Controller\Adminhtml\Seller;

use Magento\Framework\Controller\Result\Redirect as RedirectResult;
use Magento\Framework\Controller\ResultFactory;

/**
 * Seller mass delete action.
 */
class MassDelete extends AbstractAction
{
    /**
     * @inheritdoc
     */
    public function execute()
    {
        /** @var RedirectResult $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $result->setPath('*/*/index');

        $sellerIds = $this->getRequest()->getParam('selected', []);

        if (!is_array($sellerIds) || count($sellerIds) < 1) {
            $this->messageManager->addErrorMessage(__('Please select sellers.'));
            return $result;
        }

        try {
            foreach ($sellerIds as $sellerId) {
                $this->sellerRepository->deleteById((int) $sellerId);
            }
            $this->messageManager->addSuccessMessage(__('Total of %1 seller(s) were deleted.', count($sellerIds)));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $result;
    }
}
