<?php
declare(strict_types=1);

namespace Training\Seller\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Training\Seller\Api\Data\SellerInterface;

/**
 * Seller resource model.
 */
class Seller extends AbstractDb
{
    /**
     * @inheritdoc
     */
    protected function _construct(): void
    {
        $this->_init(SellerInterface::TABLE_NAME, SellerInterface::SELLER_ID);
    }
}
