<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Training\Seller\Controller\Adminhtml\Seller;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Raw as ResultRaw;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\View\Result\PageFactory;


/**
 * Action: Seller/Index
 * @author Mouad
 * @copyright 2021 SQLI
 */
class Config  extends Action
{
    public function __construct(
        PageFactory $resultPageFactory,
        Context $context)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }


    public function execute()
    {


            /** @var \Magento\Framework\View\Result\Page $resultPage */
            $resultPage = $this->resultPageFactory->create();
            return $resultPage;

    }
}
