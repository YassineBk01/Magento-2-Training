<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Training\Seller\Cron;

use Psr\Log\LoggerInterface as Logger;
use Training\Seller\Api\SellerRepositoryInterface;
class SellersLogger
{

    public function __construct
    (
        SellerRepositoryInterface $sellerRepository,
        Logger $logger
    )
    {
        $this->sellerRepository =$sellerRepository;
        $this->logger=$logger;
    }

    public function execute()
    {


        $this->logger->info($this->sellerRepository->getById(2)->getName());
    }
}
