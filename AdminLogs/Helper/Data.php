<?php

namespace Training\AdminLogs\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Data constructor.
     *
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
        $this->scopeConfig = $context->getScopeConfig();
    }

    /**
     * tracking activities enabled or disabled
     *
     * @return bool
     */
    public function isTrackingEnabled()
    {
        return (bool) $this->scopeConfig->getValue('AdminLogs/principal/tracking');
    }
    /**
     * Check if login activity is enabled.
     *
     * @return bool
     */
    public function isLoginActivityEnabled()
    {
        return (bool) $this->scopeConfig->getValue('AdminLogs/general/login_activity');
    }

    /**
     * Check if page visit history is enabled.
     *
     * @return bool
     */
    public function isPageVisitEnabled()
    {
        return (bool) $this->scopeConfig->getValue('AdminLogs/general/page_visit');
    }

    /**
     * Get the number of days to clear admin activity logs.
     *
     * @return int
     */
    public function getClearLogDays()
    {
        return (int) $this->scopeConfig->getValue('AdminLogs/general/clearlog');
    }

    /**
     * Check if a specific module is allowed.
     *
     * @param string $module
     * @return bool
     */
    public function isModuleAllowed($module)
    {
        return (bool) $this->scopeConfig->getValue('AdminLogs/module/' . $module);
    }
}
