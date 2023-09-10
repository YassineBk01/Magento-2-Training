<?php
declare(strict_types=1);

namespace Training\Seller\Controller\Adminhtml\Seller;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect as RedirectResult;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\Request\Http as HttpRequest;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Api\Data\SellerInterfaceFactory as SellerFactory;
use Training\Seller\Api\SellerRepositoryInterface as SellerRepository;

/**
 * Seller save action.
 */
class Save extends AbstractAction
{
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param SellerFactory $sellerFactory
     * @param SellerRepository $sellerRepository
     * @param DataPersistorInterface $dataPersistor
     * @param DataObjectHelper $dataObjectHelper
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        SellerFactory $sellerFactory,
        SellerRepository $sellerRepository,
        DataPersistorInterface $dataPersistor,
        DataObjectHelper $dataObjectHelper
    ) {
        parent::__construct($context, $coreRegistry, $sellerFactory, $sellerRepository, $dataObjectHelper);
        $this->dataPersistor = $dataPersistor;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        /** @var RedirectResult $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $result->setPath('*/*/');

        /** @var HttpRequest $request */
        $request = $this->getRequest();
        $data = $request->getPostValue();
        if (empty($data)) {
            return $result;
        }
        $this->dataPersistor->set('training_seller_seller', $data);

        // Get the seller id (if edit)
        $sellerId = null;
        if (!empty($data['seller_id'])) {
            $sellerId = (int) $data['seller_id'];
        }

        // Load the seller
        $seller = $this->initSeller($sellerId);

        // By default, redirect to the edit page of the seller
        $result->setPath('*/*/edit', ['seller_id' => $sellerId]);

        try {
            // Set the seller data
            $this->dataObjectHelper->populateWithArray($seller, $data, SellerInterface::class);

            // Save the seller
            $this->sellerRepository->save($seller);
            if ($sellerId === null) {
                $result->setPath('*/*/edit', ['seller_id' => $seller->getSellerId()]);
            }

            // Display success message
            $this->messageManager->addSuccessMessage(__('The seller has been saved.'));
            $this->dataPersistor->clear('training_seller_seller');

            // If requested => redirect to the list
            if (!$this->getRequest()->getParam('back')) {
                $result->setPath('*/*/');
            }
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage(
                $e,
                __('Something went wrong while saving the seller. %1', $e->getMessage())
            );
        }

        return $result;
    }
}
