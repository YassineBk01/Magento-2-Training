<?php

namespace Training\AdminLogs\Cron;

use Training\AdminLogs\Helper\Data;
use Training\AdminLogs\Model\ResourceModel\UserAction\CollectionFactory;
use Psr\Log\LoggerInterface;

class ClearLogs
{
    protected $collectionFactory;
    protected $helper;
    protected $logger;

    public function __construct(
        CollectionFactory $collectionFactory,
        Data $helper,
        LoggerInterface $logger
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->helper = $helper;
        $this->logger = $logger;
    }

    public function execute()
    {
        try {
            $clearLogDays = $this->helper->getClearLogDays();

            // Calculate the date to clear logs before
            $date = new \DateTime();
            $date->modify('-' . $clearLogDays . ' day');
            $clearBeforeDate = $date->format('Y-m-d H:i:s');

            // Soft delete the logs
            $this->softDelete($clearBeforeDate);

            // Log the success
            $this->logMessage('Logs older than ' . $clearLogDays . ' days have been cleared.');
        } catch (\Exception $e) {
            // Log the error
            $this->logMessage('An error occurred while clearing the logs: ' . $e->getMessage());
        }
    }

    protected function softDelete($clearBeforeDate)
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('is_deleted', 0)
            ->addFieldToFilter('created_at', ['lteq' => $clearBeforeDate]);

        foreach ($collection as $item) {
            $item->setData('is_deleted', 1);
            $item->save();
        }
    }

    protected function logMessage($message)
    {
        $this->logger->info($message);
    }
}
