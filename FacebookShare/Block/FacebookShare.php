<?php
namespace Training\FacebookShare\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Helper\Product as ProductHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;

class FacebookShare extends Template
{
    protected $_productHelper;
    protected $scopeConfig;

    public function __construct(
        Template\Context $context,
        ProductHelper $productHelper,
        array $data = []
    ) {
        $this->_productHelper = $productHelper;
        $this->scopeConfig = $context->getScopeConfig();
        parent::__construct($context, $data);
    }
    

    /**
     * Check if the Facebook Share module is enabled.
     *
     * @return bool
     */
    public function isModuleEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            'facebookshare/general/enabled',
            ScopeConfigInterface::SCOPE_TYPE_DEFAULT
        );
    }
}
