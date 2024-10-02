<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

namespace Tigren\Testimonial\Block;

use Magento\Framework\View\Element\Html\Link;
use Tigren\SimpleBlog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;

class CustomListLink extends Link
{
    /**
     * @var CategoryCollectionFactory
     */
    protected $categoryCollectionFactory;

    /**
     * Constructor
     *
     * @param CategoryCollectionFactory $categoryCollectionFactory
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        CategoryCollectionFactory                        $categoryCollectionFactory,
        array                                            $data = []
    )
    {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        parent::__construct($context, $data);
    }

    public function _toHtml()
    {
        $categoryCollection = $this->categoryCollectionFactory->create()
            ->addFieldToFilter('status', 1);

        $html = '<style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            list-style: none;
            min-width: 200px; /* Đặt chiều rộng tối thiểu cho menu */
            z-index: 1;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
             position: absolute;
             padding: 0;
             margin: 0;
        }

        .dropdown-item a {
            color: #A9A9A9;
            text-decoration: none;
            display: block;
            padding-left: 20px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .dropdown-item a:hover {
            color: #333;
            background-color: #f1f1f1; /* Đổi màu nền khi hover */
        }

        .dropdown-toggle::after {
            content: " ▼"; /* Thêm biểu tượng chỉ mũi tên xuống */
        }
    </style>';

        // Thêm HTML
        $html .= '<li class="level0 nav-7 category-item last level-top ui-menu-item dropdown">';
        $html .= '<a href="' . $this->getUrl($this->getPath()) . '" class="level-top ui-menu-item-wrapper dropdown-toggle"' . $this->getLinkAttributes() . '>';
        $html .= $this->escapeHtml($this->getLabel()) . '</a>';

        // Bắt đầu danh sách các mục con (dropdown items)
        $html .= '<ul class="dropdown-menu">';

        // Các mục con của dropdown (có thể tùy biến hoặc lấy từ CSDL)
        foreach ($categoryCollection as $category) {
            $categoryId = $category->getCategoryId();
            $categoryName = $category->getName();
            $html .= '<li class="dropdown-item"><a href="' . $this->getUrl('blog/post/') . 'listPost?category=' . $categoryId . '">' . $this->escapeHtml($categoryName) . '</a></li>';
        }
        // Kết thúc danh sách mục con
        $html .= '</ul>';

        // Kết thúc mục menu cha
        $html .= '</li>';

        return $html;
    }
}
