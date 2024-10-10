<?php

namespace Tigren\CustomerGroupCatalog\Block;

use Magento\Framework\View\Element\Template;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\HistoryRule\Collection as RuleCollection;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\HistoryRule\CollectionFactory;

//use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as OrderCollectionFactory;
use Magento\Customer\Model\Session;

/**
 *
 */
class RuleList extends Template
{

    /**
     * @var
     */
    protected $_ruleCollection;
    /**
     * @var Session
     */
    protected $customerSession;
    /**
     * @var OrderCollectionFactory
     * */
//    protected $orderCollection;

    /**
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param Session $customerSession
     * @param array $data
     */
    public function __construct(
        Template\Context  $context,
        CollectionFactory $collectionFactory,
        Session           $customerSession,
//        OrderCollectionFactory $orderCollection,
        array             $data = []
    )
    {
        $this->customerSession = $customerSession;
//        $this->orderCollection = $orderCollection;
        $this->_ruleColFactory = $collectionFactory;
        parent::__construct($context, $data);
    }


    /**
     * @return RuleCollection
     */
    public function getRuleItem()
    {
        if ($this->_ruleCollection === null) {
            $this->_ruleCollection = $this->_ruleColFactory->create();
        }
        return $this->_ruleCollection;
    }

//    public function getOrder()
//    {
//        $orderCollection = $this->orderCollection->create();
//        return $orderCollection;
//    }

}
