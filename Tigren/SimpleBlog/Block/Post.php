<?php

namespace Tigren\SimpleBlog\Block;

use Magento\Framework\View\Element\Template;
use Tigren\SimpleBlog\Model\ResourceModel\Post\Collection as PostCollection;
use Tigren\SimpleBlog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Request\Http;

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

    protected $_urlInterface;
    /**
     * @var Http
     */
    protected $_request;

    /**
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     * @SuppressWarnings (PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Template\Context  $context,
        CollectionFactory $collectionFactory,
        Http              $request,
        array             $data = []
    )
    {
        $this->_postColFactory = $collectionFactory;
        $this->_urlInterface = $context->getUrlBuilder();
        $this->_request = $request;
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

    public function getCurrentUrl()
    {
        return $this->_urlInterface->getCurrentUrl();
    }

    public function getPostItemByCategory()
    {
        // Lấy ID category từ URL
        $categoryId = $this->_request->getParam('category');
        return $categoryId;
    }

    public function getPostDetail()
    {
        // Lấy ID category từ URL
        $id = $this->_request->getParam('id');
        return $id;
    }
}
