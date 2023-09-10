<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Training\Seller\Controller\Seller;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\Controller\Result\Raw as ResultRaw;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\View\Result\PageFactory;
use Training\Seller\Api\SellerRepositoryInterface;
use Training\Seller\Model\ResourceModel\Seller\CollectionFactory as SellerCollectionFactory;
use Training\Seller\Helper\Data;

/**
 * Action: Seller/Index
 * @author Mouad
 * @copyright 2021 SQLI
 */
class Index extends Action implements HttpGetActionInterface
{

    public function __construct
    (
        PageFactory $resultPageFactory,
        SellerCollectionFactory $sellerCollectionFactory,
        SellerRepositoryInterface $sellerRepository,
        Data $helper,
        Context $context
    )
    {
        $this->resultPageFactory =$resultPageFactory;
        $this->sellerCollectionFactory =$sellerCollectionFactory;
        $this->sellerRepository =$sellerRepository;
        $this->helper = $helper;
        parent::__construct($context);
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
       /* $sellers = $this->sellerRepository->getList();

        foreach ($sellers->getItems() as $seller) {
            echo $seller->getName(). '<br/>';
        }*/
        //check if store > configuration > seller > general > active == yes
        if($this->helper->isActive()){
            /** @var \Magento\Framework\View\Result\Page $resultPage */
            $resultPage = $this->resultPageFactory->create();
            return $resultPage;
        }else{
            throw new NotFoundException(__('page not found'));
        }

        //$resultPage->getLayout()->getBlock('SellerList');



    }
}
