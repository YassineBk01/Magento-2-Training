<?php

namespace Training\LinkedIn\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class LinkedInProfile extends Column
{
    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     *
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param CustomerFactory    $customerFactory
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        CustomerFactory $customerFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->customerFactory = $customerFactory;
    }
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item)
            {
                $customer = $this->customerFactory->create()->load($item['entity_id']);
                $item[$this->getData('name')] = $customer->getLinkedinProfile();

            }
        }
        return $dataSource;
    }
}
