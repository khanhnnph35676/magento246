<?php

namespace Tigren\CheckPrice\Block\Product\View;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session as CustomerSession;

class CheckPrice extends Template
{
    protected $customerSession;

    public function __construct(
        Template\Context $context,
        CustomerSession  $customerSession,
        array            $data = []
    )
    {
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function isCustomerLoggedIn()
    {
        return $this->customerSession->isLoggedIn();
    }
}
