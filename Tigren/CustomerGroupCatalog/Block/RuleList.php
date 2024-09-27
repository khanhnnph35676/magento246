<?php

namespace Tigren\CustomerGroupCatalog\Block;

use Magento\Framework\View\Element\Template;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\HistoryRule\Collection as RuleCollection;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\HistoryRule\CollectionFactory;

class RuleList extends Template
{
    /**
     * Testimonial Collection
     * @var RuleCollection
     */
    protected $_ruleCollection;

    /**
     * Testimonial resource model
     * @var \Tigren\CustomerGroupCatalog\Model\ResourceModel\HistoryRule\CollectionFactory
     */
    protected $_ruleColFactory;


    /**
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     * @SuppressWarnings (PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Template\Context  $context,
        CollectionFactory $collectionFactory,
        array             $data = []
    )
    {
        $this->_ruleColFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * Get Demo Items Collection
     * @return \Tigren\CustomerGroupCatalog\Model\ResourceModel\HistoryRule\Collection
     */

    public function getRuleItem()
    {
        if ($this->_ruleCollection === null) {
            $this->_ruleCollection = $this->_ruleColFactory->create();
        }
        return $this->_ruleCollection;
    }
}
