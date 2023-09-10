<?php
declare(strict_types=1);

namespace Training\Seller\Controller\Adminhtml\Seller;

use Magento\Framework\Controller\Result\Json as JsonResult;
use Magento\Framework\Controller\ResultFactory;
use Training\Seller\Api\Data\SellerInterface;

/**
 * Seller inline edit action.
 */
class InlineEdit extends AbstractAction
{
    /**
     * @inheritdoc
     */
    public function execute()
    {
        $error = false;
        $messages = [];

        if (!$this->getRequest()->getParam('isAjax')) {
            $messages[] = __('Ajax call needed.');
            $error = true;
            return $this->getResult($messages, $error);
        }

        $postItems = $this->getRequest()->getParam('items', []);
        if (!count($postItems)) {
            $messages[] = __('Please correct the data sent.');
            $error = true;
            return $this->getResult($messages, $error);
        }

        foreach (array_keys($postItems) as $sellerId) {
            try {
                // Load the seller
                $seller = $this->sellerRepository->getById((int) $sellerId);
                $this->dataObjectHelper->populateWithArray($seller, $postItems[$sellerId], SellerInterface::class);

                // Save the seller
                $this->sellerRepository->save($seller);
            } catch (\Exception $e) {
                $messages[] = '[Seller #' . $sellerId . '] ' . __($e->getMessage());
                $error = true;
            }
        }

        return $this->getResult($messages, $error);
    }

    /**
     * Get the result.
     *
     * @param string[] $messages
     * @param bool $error
     * @return JsonResult
     */
    private function getResult(array $messages, bool $error): JsonResult
    {
        /** @var JsonResult $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $result->setData(
            [
                'messages' => $messages,
                'error' => $error,
            ]
        );

        return $result;
    }
}
