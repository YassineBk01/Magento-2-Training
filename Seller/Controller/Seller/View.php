<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Training\Seller\Controller\Seller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Raw as ResultRaw;
use Magento\Framework\Controller\ResultFactory;
use Training\Seller\Api\SellerRepositoryInterface;
use Training\Seller\Model\ResourceModel\Seller\CollectionFactory as SellerCollectionFactory;

/**
 * Action: Seller/Index
 * @author Mouad
 * @copyright 2021 SQLI
 */
class View extends Action
{

    public function __construct
    (
        SellerCollectionFactory $sellerCollectionFactory,
        SellerRepositoryInterface $sellerRepository,
        Context $context
    )
    {
        $this->sellerCollectionFactory =$sellerCollectionFactory;
        $this->sellerRepository =$sellerRepository;
        parent::__construct($context);
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        //get identifier
        $sellerIdentifier = $this->getRequest()->getParam('identifier');
        if(!$sellerIdentifier){
            return null;
        }

        $seller = $this->sellerRepository->getByIdentifier($sellerIdentifier);

        if(!$seller->getId()){
            return null;
        }

        echo $seller->getName();
    }
}
