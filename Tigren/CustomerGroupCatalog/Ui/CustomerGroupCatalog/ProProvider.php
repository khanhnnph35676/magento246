<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */


namespace Tigren\CustomerGroupCatalog\Ui\CustomerGroupCatalog;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;

class ProProvider implements OptionSourceInterface
{
    protected ProductCollectionFactory $productColFac;

    public function __construct(
        ProductCollectionFactory $productColFac)
    {
        $this->productColFac = $productColFac;
    }

    public function toOptionArray()
    {
        $options = [];
        $proCol = $this->productColFac->create();
        $proCol->addAttributeToSelect('name')
            ->addAttributeToFilter('status', 1);
        foreach ($proCol as $value) {
            $options[] = [
                'value' => $value->getId(),
                'label' => $value->getName() // Có thể sử dụng getEmail() hoặc thuộc tính khác
            ];
        }

        return $options;
    }
}
