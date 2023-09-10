<?php
declare(strict_types=1);

namespace Training\Seller\Block\Adminhtml\Seller\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Training\Seller\Api\SellerRepositoryInterface;

/**
 * Abstract button block.
 */
abstract class AbstractButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var SellerRepositoryInterface
     */
    protected $sellerRepository;

    /**
     * @param Context $context
     * @param SellerRepositoryInterface $sellerRepository
     */
    public function __construct(Context $context, SellerRepositoryInterface $sellerRepository)
    {
        $this->context = $context;
        $this->sellerRepository = $sellerRepository;
    }

    /**
     * Return the seller ID.
     *
     * @return int|null
     */
    public function getSellerId(): ?int
    {
        try {
            $sellerId = (int) $this->context->getRequest()->getParam('seller_id');
            $seller = $this->sellerRepository->getById($sellerId);

            return $seller->getSellerId();
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * Generate url by route and parameters.
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
