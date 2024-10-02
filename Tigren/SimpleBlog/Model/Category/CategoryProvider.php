<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */


namespace Tigren\SimpleBlog\Model\Category;

use Magento\Framework\Data\OptionSourceInterface;
use Tigren\SimpleBlog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;

class CategoryProvider implements OptionSourceInterface
{
    protected CategoryCollectionFactory $categoryCollectionFactory;

    public function __construct(
        CategoryCollectionFactory $categoryCollectionFactory)
    {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
    }

    public function toOptionArray()
    {
        $options = [];
        $categoryCollection = $this->categoryCollectionFactory->create();

        foreach ($categoryCollection as $category) {
            $options[] = [
                'value' => $category->getCategoryId(),
                'label' => $category->getName() // Có thể sử dụng getEmail() hoặc thuộc tính khác
            ];
        }

        return $options;
    }
}
