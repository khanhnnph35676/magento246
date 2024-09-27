<?php

namespace Tigren\HideInfo\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Tigren\HideInfo\Helper\Data as ProductAvailableHelper;

class SalableObserver implements ObserverInterface
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
        if (!$this->_helper->isAvailableAddToCart()) {
            $salable = $observer->getEvent()->getSalable();
            $salable->setIsSalable(false);
        }
    }
}
