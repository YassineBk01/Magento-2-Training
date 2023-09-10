<?php

namespace Training\Seller\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Training\Seller\Api\Data\SellerInterfaceFactory;
use Training\Seller\Model\SellerRepository;

class CreateMainSeller implements DataPatchInterface
{

    public function __construct(
        SellerInterfaceFactory $sellerFactory,
        SellerRepository $sellerRepository
    )
    {
        $this->sellerFactory = $sellerFactory;
        $this->sellerRepository = $sellerRepository;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $seller = $this->sellerFactory->create();
        $seller->setIdentifier('identifier_test');
        $seller->setName('name_test');
        $this->sellerRepository->save($seller);
    }
}
