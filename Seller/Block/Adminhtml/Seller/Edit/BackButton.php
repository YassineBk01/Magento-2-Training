<?php
declare(strict_types=1);

namespace Training\Seller\Block\Adminhtml\Seller\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Back button block.
 */
class BackButton extends AbstractButton implements ButtonProviderInterface
{
    /**
     * @inheritdoc
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10,
        ];
    }

    /**
     * Get URL for back button.
     *
     * @return string
     */
    public function getBackUrl(): string
    {
        return $this->getUrl('*/*/');
    }
}
