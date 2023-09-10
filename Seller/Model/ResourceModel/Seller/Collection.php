<?php
declare(strict_types=1);

namespace Training\Seller\Model\ResourceModel\Seller;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Model\ResourceModel\Seller as SellerResource;
use Training\Seller\Model\Seller;

/**
 * Seller collection.
 */
class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected function _construct(): void
    {
        $this->_init(Seller::class, SellerResource::class);
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        return $this->_toOptionArray(SellerInterface::SELLER_ID, SellerInterface::NAME);
    }
}
