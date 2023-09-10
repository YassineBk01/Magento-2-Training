<?php

namespace Training\AdminLogs\Ui\DataProvider\UserAction;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Training\AdminLogs\Model\ResourceModel\UserAction\CollectionFactory as UserActionCollectionFactory;

class SessionLogsDataProvider extends AbstractDataProvider
{
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        UserActionCollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->collection->getSelect()->group('session_id');
    }


}
