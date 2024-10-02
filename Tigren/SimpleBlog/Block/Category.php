<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

namespace Tigren\SimpleBlog\Block;

use Magento\Framework\View\Element\Template;
use Tigren\SimpleBlog\Model\ResourceModel\Category\Collection as CategoryCollection;
use Tigren\SimpleBlog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\UrlInterface;

class Category extends Template
{

    /**
     * Post Collection
     * @var CategoryCollection
     */
    protected $_categoryCol;
    protected $_url;
    /**
     * Post resource model
     * @var \Tigren\SimpleBlog\Model\ResourceModel\Category\CollectionFactory
     */
    protected $_categoryColFactory;


    /**
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     * @SuppressWarnings (PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Template\Context  $context,
        CollectionFactory $collectionFactory,
        UrlInterface      $url,
        array             $data = []
    )
    {
        $this->_url = $url;
        $this->_categoryColFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * Get Demo Items Collection
     * @return \Tigren\SimpleBlog\Model\ResourceModel\Category\Collection
     */

    public function getCategoryItem()
    {
        if ($this->_categoryCol === null) {
            $this->_categoryCol = $this->_categoryColFactory->create();
        }
        return $this->_categoryCol;
    }

    public function getCurrentUrl()
    {
        return $this->_url->getCurrentUrl();
    }
}
