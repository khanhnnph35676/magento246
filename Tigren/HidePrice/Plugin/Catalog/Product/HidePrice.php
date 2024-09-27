<?php

namespace Tigren\HidePrice\Plugin\Catalog\Product;

use Magento\Catalog\Model\Product as ProductPrice;
use Magento\Customer\Model\SessionFactory;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\CustomerGroupCatalog\CollectionFactory;


/**
 * Hide Price Plugin
 */
class HidePrice
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @var SessionFactory
     */
    protected $sessionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     * @param SessionFactory $sessionFactory
     */
    public function __construct(CollectionFactory $collectionFactory, SessionFactory $sessionFactory)
    {
        $this->sessionFactory = $sessionFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param ProductPrice $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\Phrase|mixed|null
     */
    public function aroundGetPrice(ProductPrice $subject, \Closure $proceed)
    {
        $session = $this->sessionFactory->create();
        if (!$session->isLoggedIn()) {
            return null;
        }
        return $proceed();
    }
}
