<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

namespace Tigren\CustomerGroupCatalog\Ui\CustomerGroupCatalog;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Store\Model\ResourceModel\Store\CollectionFactory as StoreCollectionFactory;

class StoreProvider implements OptionSourceInterface
{
    protected $storeCollectionFactory;

    public function __construct(
        StoreCollectionFactory $storeCollectionFactory
    )
    {
        $this->storeCollectionFactory = $storeCollectionFactory;
    }

    public function toOptionArray()
    {
        $options = [];
        $storeCollection = $this->storeCollectionFactory->create();

        foreach ($storeCollection as $store) {
            $options[] = [
                'value' => $store->getId(),
                'label' => $store->getName()
            ];
        }

        return $options;
    }
}
