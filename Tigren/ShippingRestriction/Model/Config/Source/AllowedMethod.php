<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */


namespace Tigren\ShippingRestriction\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Magento\Dhl\Model\Config\Source\AllowedMethods as DhlAllowedMethods;

class AllowedMethod implements ArrayInterface
{
    protected $dhlAllowedMethods;

    public function __construct(DhlAllowedMethods $dhlAllowedMethods)
    {
        $this->dhlAllowedMethods = $dhlAllowedMethods;
    }

    public function toOptionArray()
    {
        return $this->dhlAllowedMethods->toOptionArray(); // Lấy danh sách phương thức từ DHL
    }
}
