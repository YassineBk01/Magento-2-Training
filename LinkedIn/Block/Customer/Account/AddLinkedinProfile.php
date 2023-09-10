<?php

declare(strict_types=1);

namespace Training\LinkedIn\Block\Customer\Account;

use Training\LinkedIn\Helper\Data;
use Magento\Framework\View\Element\Template;

class AddLinkedinProfile extends Template
{
    protected $helper;

    public function __construct(
        Template\Context $context,
        Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->helper = $helper;
    }

    public function isLinkedInProfileRequired()
    {
        return (bool)$this->helper->isLinkedInProfileRequired();
    }

    public function isLinkedInProfileVisible()
    {
        return (bool)$this->helper->isLinkedInProfileVisible();

    }


}
