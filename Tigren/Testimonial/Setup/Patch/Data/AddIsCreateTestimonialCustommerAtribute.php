<?php
declare(strict_types=1);

namespace Tigren\Testimonial\Setup\Patch\Data;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetup;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Entity\Attribute\Set;
use Magento\Eav\Model\Entity\Attribute\SetFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class AddIsCreateTestimonialCustommerAtribute implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CustomerSetupFactory $customerSetupFactory
     * @param SetFactory $attributeSetFactory
     */
    public function __construct(
        private readonly ModuleDataSetupInterface $moduleDataSetup,
        private readonly CustomerSetupFactory     $customerSetupFactory,
        private readonly SetFactory               $attributeSetFactory
    )
    {

    }

    public function apply(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        /**
         * @var CustomerSetup $customerSetup
         */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $customerEntity = $customerSetup->getEavConfig()->getEntityType(Customer::ENTITY);
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();
        /**
         * @var $attributeSet Set
         */
        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

        $customerSetup > addAttribute(
            Customer::ENTITY,
            'is_created_testimonial',
            [
                'label' => 'is_created_testimonial',
                'input' => 'boolean',
                'type' => 'int',
                'default' => '0', //mac dinh la false
                'source' => '',
                'required' => false,
                'position' => 333,
                'visible' => true,
                'system' => false,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'is_searchable_in_grid' => true,
                'backend' => '',
            ]
        );
        $attribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'is_created_testimonial');
        $attribute->addData([
            'used_in_forms' => [
                'adminhtml_checkout'
            ]
        ]);
        $attribute->addData([
            'attribute_set_id' => $attributeSetId,
            'attribute_group_id' => $attributeGroupId,
        ]);
        $attribute->save();
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public function revert(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        /**
         * @var CustomerSetup $customerSetup
         */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $customerSetup->removeAttribute(\Magento\Customer\Model\Customer::ENTITY, 'is_created_testimonial');
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @return {inheritdoc}
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * @return {inheritdoc}
     */
    public static function getDependencies(): array
    {
        return [];
    }
}
