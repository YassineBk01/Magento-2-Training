<?php
declare(strict_types=1);

namespace Training\Seller\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Model\ResourceModel\Seller as SellerResource;

/**
 * Seller entity.
 */
class Seller extends AbstractModel implements SellerInterface, IdentityInterface
{
    /**
     * Seller cache tag.
     */
    const CACHE_TAG = 'training_seller';

    /**
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * @inheritdoc
     */
    protected function _construct(): void
    {
        $this->_init(SellerResource::class);
    }

    /**
     * @inheritdoc
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId(), self::CACHE_TAG . '_' . $this->getIdentifier()];
    }

    /**
     * @inheritdoc
     */
    public function getSellerId(): ?int
    {
        $sellerId = $this->getId();

        if ($sellerId !== null) {
            $sellerId = (int) $sellerId;
        }

        return $sellerId;
    }

    /**
     * @inheritdoc
     */
    public function setSellerId(int $value): SellerInterface
    {
        return $this->setId($value);
    }

    /**
     * @inheritdoc
     */
    public function getIdentifier(): ?string
    {
        return $this->getData(self::IDENTIFIER);
    }

    /**
     * @inheritdoc
     */
    public function setIdentifier(string $value): SellerInterface
    {
        return $this->setData(self::IDENTIFIER, $value);
    }

    /**
     * @inheritdoc
     */
    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }
    /**
     * @inheritdoc
     */
    public function setName(string $value): SellerInterface
    {
        return $this->setData(self::NAME, $value);
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritdoc
     */
    public function setCreatedAt(string $value): SellerInterface
    {
        return $this->setData(self::CREATED_AT, $value);
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritdoc
     */
    public function setUpdatedAt(string $value): SellerInterface
    {
        return $this->setData(self::UPDATED_AT, $value);
    }
}
