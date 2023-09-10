<?php
declare(strict_types=1);

namespace Training\Seller\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Training\Seller\Api\Data\SellerInterface;

/**
 * Seller repository interface.
 *
 * @api
 */
interface SellerRepositoryInterface
{
    /**
     * Retrieve a seller by id.
     *
     * @param int $sellerId
     * @return \Training\Seller\Api\Data\SellerInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $sellerId): SellerInterface;

    /**
     * Retrieve a seller by identifier.
     *
     * @param string $identifier
     * @return \Training\Seller\Api\Data\SellerInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getByIdentifier(string $identifier): SellerInterface;

    /**
     * Save a seller.
     *
     * @param \Training\Seller\Api\Data\SellerInterface $seller
     * @return \Training\Seller\Api\Data\SellerInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(SellerInterface $seller): SellerInterface;

    /**
     * Delete a seller.
     *
     * @param \Training\Seller\Api\Data\SellerInterface $seller
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(SellerInterface $seller): bool;

    /**
     * Delete a seller by id.
     *
     * @param int $sellerId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById(int $sellerId): bool;

    /**
     * Delete a seller by identifier.
     *
     * @param string $identifier
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteByIdentifier(string $identifier): bool;

    /**
     * Retrieve sellers that match the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Training\Seller\Api\Data\SellerSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface;
}
