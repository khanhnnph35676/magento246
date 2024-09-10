<?php

declare(strict_types=1);

namespace Tigren\Testimonial\Block\Adminhtml\Testimonial\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;

class GenericButton
{
    /**
     * @param UrlInterface $url
     * @param RequestInterface $request
     */
    public function __construct(
        private readonly UrlInterface     $url,
        private readonly RequestInterface $request
    )
    {
    }

    /**
     * Return CMS block ID
     *
     * @return int
     */
    public function getTestimonialId(): int
    {
        return (int)$this->request->getParam('entity_id', 0);
    }

    /**
     * @param string $route
     * @param array $params
     * @return  string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->url->getUrl($route, $params);
    }
}
