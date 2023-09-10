<?php
namespace Training\LinkedIn\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_LINKEDIN_PROFILE_REQUIRED = 'linkedin_profile/general/required';
    const XML_PATH_LINKEDIN_PROFILE_VISIBILITY ='linkedin_profile/general/visibility';


    public function __construct(Context $context)
    {
        parent::__construct($context);
    }
    /**
     * Check whether LinkedIn Profile is required or not.
     *
     * @return bool
     */
    public function isLinkedInProfileRequired()
    {
        return (bool) $this->scopeConfig->getValue(
            self::XML_PATH_LINKEDIN_PROFILE_REQUIRED,
            ScopeInterface::SCOPE_STORE
        );
    }
    /**
     * Check whether LinkedIn Profile is visible for customer or not.
     *
     * @return bool
     */
    public function isLinkedInProfileVisible()
    {
        return (bool) $this->scopeConfig->getValue(
            self::XML_PATH_LINKEDIN_PROFILE_VISIBILITY,
            ScopeInterface::SCOPE_STORE
        );
    }
}
