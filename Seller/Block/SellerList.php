<?php

namespace Training\Seller\Block;

use Magento\Framework\View\Element\Template;
use Training\Seller\Api\SellerRepositoryInterface;


class SellerList extends Template
{
    public function __construct(
        SellerRepositoryInterface $sellerRepository,
        Template\Context $context,
        array $data = []
    )
    {
        $this->sellerRepository =$sellerRepository;
        parent::__construct($context, $data);
    }

    public function getSellers(){
        return $this->sellerRepository->getList()->getItems();
    }

}
