<?php
declare(strict_types=1);

namespace Training\Seller\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Phrase;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Api\Data\SellerInterfaceFactory;
use Training\Seller\Api\Data\SellerSearchResultsInterfaceFactory;
use Training\Seller\Api\SellerRepositoryInterface;
use Training\Seller\Model\ResourceModel\Seller as SellerResourceModel;
use Training\Seller\Model\ResourceModel\Seller\CollectionFactory as SellerCollectionFactory;

/**
 * Seller repository.
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class SellerRepository implements SellerRepositoryInterface
{
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var SellerInterfaceFactory
     */
    private $sellerFactory;

    /**
     * @var SellerResourceModel
     */
    private $sellerResource;

    /**
     * @var SellerCollectionFactory
     */
    private $sellerCollectionFactory;

    /**
     * @var SellerSearchResultsInterfaceFactory
     */
    private $sellerSearchResultsFactory;

    /**
     * @var array
     */
    private $cacheById = [];

    /**
     * @var array
     */
    private $cacheByIdentifier = [];

    /**
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SellerInterfaceFactory $sellerFactory
     * @param SellerResourceModel $sellerResource
     * @param SellerCollectionFactory $sellerCollectionFactory
     * @param SellerSearchResultsInterfaceFactory $sellerSearchResultsFactory
     */
    public function __construct(
        CollectionProcessorInterface $collectionProcessor,
        SellerInterfaceFactory $sellerFactory,
        SellerResourceModel $sellerResource,
        SellerCollectionFactory $sellerCollectionFactory,
        SellerSearchResultsInterfaceFactory $sellerSearchResultsFactory
    ) {
        $this->collectionProcessor = $collectionProcessor;
        $this->sellerFactory = $sellerFactory;
        $this->sellerResource = $sellerResource;
        $this->sellerCollectionFactory = $sellerCollectionFactory;
        $this->sellerSearchResultsFactory = $sellerSearchResultsFactory;
    }

    /**
     * @inheritdoc
     * @SuppressWarnings(PMD.StaticAccess)
     */
    public function getById(int $sellerId): SellerInterface
    {
        if (!isset($this->cacheById[$sellerId])) {
            /** @var Seller $seller */
            $seller = $this->sellerFactory->create();
            $this->sellerResource->load($seller, $sellerId);

            if (!$seller->getId()) {
                throw NoSuchEntityException::singleField('sellerId', $sellerId);
            }

            $this->cacheById[$sellerId] = $seller;
            $this->cacheByIdentifier[$seller->getIdentifier()] = $seller;
        }

        return $this->cacheById[$sellerId];
    }

    /**
     * @inheritdoc
     * @SuppressWarnings(PMD.StaticAccess)
     */
    public function getByIdentifier(string $identifier): SellerInterface
    {
        if (!isset($this->cacheByIdentifier[$identifier])) {
            /** @var Seller $seller */
            $seller = $this->sellerFactory->create();
            $this->sellerResource->load($seller, $identifier, SellerInterface::IDENTIFIER);

            if (!$seller->getId()) {
                throw NoSuchEntityException::singleField('identifier', $identifier);
            }

            $this->cacheById[$seller->getId()] = $seller;
            $this->cacheByIdentifier[$identifier] = $seller;
        }

        return $this->cacheByIdentifier[$identifier];
    }

    /**
     * @inheritdoc
     */
    public function save(SellerInterface $seller): SellerInterface
    {
        try {
            /** @var Seller $seller */
            $this->sellerResource->save($seller);

            unset($this->cacheById[$seller->getId()]);
            $identifier = $seller->getData(SellerInterface::IDENTIFIER);
            unset($this->cacheByIdentifier[$identifier]);
        } catch (\Exception $e) {
            $msg = new Phrase($e->getMessage());
            throw new CouldNotSaveException($msg);
        }

        return $seller;
    }

    /**
     * @inheritdoc
     */
    public function delete(SellerInterface $seller): bool
    {
        try {
            /** @var Seller $seller */
            $this->sellerResource->delete($seller);

            unset($this->cacheById[$seller->getId()]);
            $identifier = $seller->getData(SellerInterface::IDENTIFIER);
            unset($this->cacheByIdentifier[$identifier]);
        } catch (\Exception $e) {
            $msg = new Phrase($e->getMessage());
            throw new CouldNotDeleteException($msg);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById(int $sellerId): bool
    {
        return $this->delete($this->getById($sellerId));
    }

    /**
     * @inheritdoc
     */
    public function deleteByIdentifier(string $identifier): bool
    {
        return $this->delete($this->getByIdentifier($identifier));
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface
    {
        $collection = $this->sellerCollectionFactory->create();
        $searchResults = $this->sellerSearchResultsFactory->create();

        if ($searchCriteria) {
            $searchResults->setSearchCriteria($searchCriteria);
            $this->collectionProcessor->process($searchCriteria, $collection);
        }

        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }
}
