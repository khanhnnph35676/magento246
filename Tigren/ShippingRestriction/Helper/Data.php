<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

namespace Tigren\ShippingRestriction\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Data
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getDhlAllowedMethods()
    {
        // Đường dẫn cấu hình đến Allowed Methods của DHL
        $configPath = 'carriers/dhl/allowed_methods';

        // Lấy giá trị của cấu hình
        $allowedMethods = $this->scopeConfig->getValue($configPath, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        // Giá trị trả về sẽ là một chuỗi với các phương thức được chọn, ngăn cách bởi dấu phẩy
        $methodsArray = explode(',', $allowedMethods);

        return $methodsArray;
    }
}


