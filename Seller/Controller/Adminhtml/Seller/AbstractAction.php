<?php
declare(strict_types=1);

namespace Training\Seller\Controller\Adminhtml\Seller;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Registry;
use Training\Seller\Api\Data\SellerInterface as Seller;
use Training\Seller\Api\Data\SellerInterfaceFactory as SellerFactory;
use Training\Seller\Api\SellerRepositoryInterface as SellerRepository;

/**
 * Abstract admin action.
 */
abstract class AbstractAction extends Action
{
    /**
     * Authorization level.
     */
    const ADMIN_RESOURCE = 'Training_Seller::manage';

    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * @var SellerFactory
     */
    protected $sellerFactory;

    /**
     * @var SellerRepository
     */
    protected $sellerRepository;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param SellerFactory $sellerFactory
     * @param SellerRepository $sellerRepository
     * @param DataObjectHelper $dataObjectHelper
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        SellerFactory $sellerFactory,
        SellerRepository $sellerRepository,
        DataObjectHelper $dataObjectHelper
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->sellerFactory = $sellerFactory;
        $this->sellerRepository = $sellerRepository;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context);
    }

    /**
     * Init the current model.
     *
     * @param int|null $sellerId
     * @return Seller
     * @throws NotFoundException
     */
    protected function initSeller(?int $sellerId): Seller
    {
        $seller = $this->sellerFactory->create();

        // Initial checking
        if ($sellerId) {
            try {
                $seller = $this->sellerRepository->getById($sellerId);
            } catch (NoSuchEntityException $e) {
                throw new NotFoundException(__('This seller does not exist.'));
            }
        }

        // Register model to use later in blocks
        $this->coreRegistry->register('current_seller', $seller);

        return $seller;
    }
}
