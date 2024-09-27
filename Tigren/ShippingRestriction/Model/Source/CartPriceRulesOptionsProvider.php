<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */


namespace Tigren\ShippingRestriction\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\SalesRule\Model\ResourceModel\Rule\CollectionFactory as SalesRuleCollectionFactory;

/**
 * Cart Price Rules Provider
 */
class CartPriceRulesOptionsProvider implements OptionSourceInterface
{
    /**
     * @var SalesRuleCollectionFactory
     */
    protected $salesRuleCollectionFactory;

    /**
     * @param SalesRuleCollectionFactory $salesRuleCollectionFactory
     */
    public function __construct(SalesRuleCollectionFactory $salesRuleCollectionFactory)
    {
        $this->salesRuleCollectionFactory = $salesRuleCollectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {

        $options = [];
        $options[] = [
            'value' => '0',
            'label' => '-- Please Select--'
        ];
        $ruleCollection = $this->salesRuleCollectionFactory->create();
        foreach ($ruleCollection as $rule) {
            $options[] = [
                'value' => $rule->getId(),
                'label' => $rule->getName()
            ];
        }

        return $options;
    }
}
