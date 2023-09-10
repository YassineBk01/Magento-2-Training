<?php

namespace Training\AdminLogs\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;
use Magento\Framework\Option\ArrayInterface;

class IsActive implements ArrayInterface
{
    /**
     * @var Escaper
     */
    protected $escaper;

    /**
     * Constructor
     *
     * @param Escaper $escaper
     */
    public function __construct(
        Escaper $escaper
    ) {
        $this->escaper = $escaper;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Active')],
            ['value' => 0, 'label' => __('Inactive')]
        ];
    }


}
