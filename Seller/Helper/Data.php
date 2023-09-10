<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Training\Seller\Helper;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Tax\Api\Data\TaxClassKeyInterface;
use Magento\Tax\Model\Config;

/**
 * Seller data helper
 *
 * @api
 *
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @since 100.0.2
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const ACTIVE = 'seller/general/active';

    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    public function isActive(): ?int
    {
       $active = $this->scopeConfig->isSetFlag(
            self::ACTIVE,
            ScopeInterface::SCOPE_STORE
        );
        return isset($active) ? (int)$active : null;
    }
}
