<?php

declare(strict_types=1);

namespace Training\LinkedIn\Block\Customer\Account;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Message\ManagerInterface;
use Training\LinkedIn\Helper\Data;
use Magento\Framework\View\Element\Template;

class EditLinkedinProfile extends Template
{
    protected $helper;
    protected $customerSession;
    protected $customerRepository;
    protected $messageManager;
    protected $request;

    public function __construct(
        Template\Context $context,
        Data $helper,
        Session $customerSession,
        CustomerRepositoryInterface $customerRepository,
        ManagerInterface $messageManager,
        RequestInterface $request,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->helper = $helper;
        $this->customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
        $this->messageManager = $messageManager;
        $this->request = $request;
    }

    public function isLinkedInProfileRequired()
    {
        return (bool)$this->helper->isLinkedInProfileRequired();
    }

    public function getLinkedInProfile()
    {
        $customer = $this->customerSession->getCustomerData();
        return $customer->getCustomAttribute('linkedin_profile') ? $customer->getCustomAttribute('linkedin_profile')->getValue() : '';
    }

    public function isLinkedInProfileVisible()
    {
        return (bool)$this->helper->isLinkedInProfileVisible();

    }

}
