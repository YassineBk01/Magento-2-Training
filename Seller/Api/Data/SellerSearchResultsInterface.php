<?php
declare(strict_types=1);

namespace Training\Seller\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Seller search results interface.
 *
 * @api
 */
interface SellerSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get the seller list.
     *
     * @return \Training\Seller\Api\Data\SellerInterface[]
     */
    public function getItems(): array;

    /**
     * Set the seller list.
     *
     * @param \Training\Seller\Api\Data\SellerInterface[] $items
     * @return $this
     */
    public function setItems(array $items): SellerSearchResultsInterface;
}
