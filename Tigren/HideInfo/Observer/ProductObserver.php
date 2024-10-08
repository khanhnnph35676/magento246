<?php

namespace Tigren\HideInfo\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Tigren\HideInfo\Helper\Data as ProductAvailableHelper;

class ProductObserver implements ObserverInterface
{
    protected $_helper;

    public function __construct(
        ProductAvailableHelper $helper
    )
    {
        $this->_helper = $helper;
    }

    public function execute(Observer $observer)
    {
        if (!$this->_helper->isAvailablePrice()) {
            $product = $observer->getEvent()->getProduct();
            $product->setCanShowPrice(false);
        }
    }
}
