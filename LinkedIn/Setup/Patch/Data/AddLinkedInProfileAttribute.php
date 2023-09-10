<?php

namespace Training\LinkedIn\Setup\Patch\Data;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Training\LinkedIn\Helper\Data as LinkedInHelper;

class AddLinkedInProfileAttribute implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var LinkedInHelper
     */
    private $linkedInHelper;

    /**
     * @var CustomerSetupFactory
     */
    protected $customerSetupFactory;

    /**
     * @var AttributeSetFactory
     */
    protected $attributeSetFactory;

    /**
     * AddLinkedInProfileAttribute constructor.
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CustomerSetupFactory $customerSetupFactory
     * @param AttributeSetFactory $attributeSetFactory
     * @param LinkedInHelper $linkedInHelper
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerSetupFactory     $customerSetupFactory,
        AttributeSetFactory      $attributeSetFactory,
        LinkedInHelper           $linkedInHelper
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
        $this->linkedInHelper = $linkedInHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $customerSetup = $this->customerSetupFactory->create();
        $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();

        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

        $customerSetup->addAttribute(
            Customer::ENTITY,
            'linkedin_profile',
            [
                'type' => 'varchar',
                'label' => 'LinkedIn Profile',
                'input' => 'text',
                'required' => $this->linkedInHelper->isLinkedInProfileRequired(),
                'visible' => true,
                'user_defined' => true,
                'sort_order' => 1000,
                'position' => 1000,
                'system' => 0,
                'validate_urls' => true,
                'max_length' => 250,
            ]
        );

        $sampleAttribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'linkedin_profile');
        $sampleAttribute->setData('attribute_set_id', $attributeSetId);
        $sampleAttribute->setData('attribute_group_id', $attributeGroupId);
        $sampleAttribute->setData('used_in_forms', ['adminhtml_customer', 'customer_account_create', 'customer_account_edit']);
        $sampleAttribute->save();

        $this->moduleDataSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public function revert()
    {
        $this->moduleDataSetup->startSetup();

        $customerSetup = $this->customerSetupFactory->create();
        $customerSetup->removeAttribute(Customer::ENTITY, 'linkedin_profile');

        $this->moduleDataSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }

}
