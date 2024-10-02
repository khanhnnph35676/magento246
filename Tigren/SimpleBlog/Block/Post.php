<?php

namespace Tigren\SimpleBlog\Block;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Tigren\SimpleBlog\Model\ResourceModel\Post\Collection as PostCollection;
use Tigren\SimpleBlog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Store\Model\ScopeInterface;
use Magento\Customer\Model\SessionFactory;

class Post extends Template
{

    /**
     * Post Collection
     * @var PostCollection
     */
    protected $_postCol;

    /**
     * Post resource model
     * @var \Tigren\SimpleBlog\Model\ResourceModel\Post\CollectionFactory
     */
    protected $_postColFactory;


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
        $this->_postColFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * Get Demo Items Collection
     * @return \Tigren\SimpleBlog\Model\ResourceModel\Post\Collection
     */

    public function getPostItem()
    {
        if ($this->_postCol === null) {
            $this->_postCol = $this->_postColFactory->create();
        }
        return $this->_postCol;
    }
}
