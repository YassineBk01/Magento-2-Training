<?php
declare(strict_types=1);

namespace Training\Seller\Block\Adminhtml\Seller\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Delete button block.
 */
class DeleteButton extends AbstractButton implements ButtonProviderInterface
{
    /**
     * @inheritdoc
     */
    public function getButtonData(): array
    {
        $data = [];
        if ($this->getSellerId()) {
            $message = (string) __('Are you sure you want to delete this seller?');
            $message = htmlentities($message);

            $data = [
                'label' => __('Delete Seller'),
                'class' => 'delete',
                'on_click' => "deleteConfirm('{$message}', '{$this->getDeleteUrl()}')",
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * Get URL for delete button.
     *
     * @return string
     */
    public function getDeleteUrl(): string
    {
        return $this->getUrl('*/*/delete', ['seller_id' => $this->getSellerId()]);
    }
}
