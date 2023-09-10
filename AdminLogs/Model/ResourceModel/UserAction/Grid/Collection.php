<?php

namespace Training\AdminLogs\Model\ResourceModel\UserAction\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Psr\Log\LoggerInterface as Logger;

class Collection extends SearchResult {

    protected function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $manager,
        $mainTable = "user_action",
        $resourceModel = "Training\AdminLogs\Model\ResourceModel\UserAction"
    )
    {
        parent::__construct( $entityFactory,
                            $logger,
                            $fetchStrategy,
                            $manager,
                            $mainTable,
                            $resourceModel);
    }


    protected function _prepareCollection()
    {
        $collection = $this->_collectionFactory->create();

        return parent::_prepareCollection();
    }
}
