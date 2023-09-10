<?php
declare(strict_types=1);

namespace Training\Seller\Api\Data;

/**
 * Seller interface.
 *
 * @api
 */
interface SellerInterface
{
    /**
     * Name of the seller table.
     */
    const TABLE_NAME = 'training_seller';

    /**#@+
     * Seller field names.
     */
    const SELLER_ID = 'seller_id';
    const IDENTIFIER = 'identifier';
    const NAME = 'name';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**#@-*/

    /**
     * Get the seller id.
     *
     * @return int|null
     */
    public function getSellerId(): ?int;

    /**
     * Set the seller id.
     *
     * @param int $value
     * @return $this
     */
    public function setSellerId(int $value): SellerInterface;

    /**
     * Get the seller identifier.
     *
     * @return string|null
     */
    public function getIdentifier(): ?string;

    /**
     * Set the seller identifier.
     *
     * @param string $value
     * @return $this
     */
    public function setIdentifier(string $value): SellerInterface;

    /**
     * Get the seller name.
     *
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * Set the seller name.
     *
     * @param string $value
     * @return $this
     */
    public function setName(string $value): SellerInterface;

    /**
     * Get the creation time.
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * Set the creation time.
     *
     * @param string $value
     * @return $this
     */
    public function setCreatedAt(string $value): SellerInterface;

    /**
     * Get the modification time.
     *
     * @return string|null
     */
    public function getUpdatedAt(): ?string;

    /**
     * Set the modification time.
     *
     * @param string $value
     * @return $this
     */
    public function setUpdatedAt(string $value): SellerInterface;
}
