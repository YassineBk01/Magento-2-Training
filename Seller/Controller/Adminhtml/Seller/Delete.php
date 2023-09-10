<?php
declare(strict_types=1);

namespace Training\Seller\Controller\Adminhtml\Seller;

use Magento\Framework\Controller\Result\Redirect as RedirectResult;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Seller delete action.
 */
class Delete extends AbstractAction
{
    /**
     * @inheritdoc
     */
    public function execute()
    {
        /** @var RedirectResult $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $result->setPath('*/*/index');

        try {
            $sellerId = (int) $this->getRequest()->getParam('seller_id');
            $this->sellerRepository->deleteById($sellerId);
            $this->messageManager->addSuccessMessage(__('The seller has been deleted.'));
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage(__('The seller to delete does not exist.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $result;
    }
}
