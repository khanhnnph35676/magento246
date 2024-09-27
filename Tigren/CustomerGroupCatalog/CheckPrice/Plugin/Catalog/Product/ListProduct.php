<?php

namespace Tigren\CheckPrice\Plugin\Catalog\Product;

use Magento\Customer\Model\Session;

class ListProduct
{
    protected $customerSession;

    public function __construct(Session $customerSession)
    {
        $this->customerSession = $customerSession;
    }

    public function beforeToHtml(\Magento\Catalog\Block\Product\ProductList\Item\Block $subject)
    {
        if (!$this->customerSession->isLoggedIn()) {
            $subject->setTemplate('Tigren_CheckPrice::product/list/check_price.phtml');
        } else {
            $this->logger->info('Khách hàng đã đăng nhập!');
        }
    }
}
