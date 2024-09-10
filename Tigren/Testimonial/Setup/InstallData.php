<?php

namespace Tigren\Testimonial\Setup;

use Tigren\Testimonial\Model\Testimonial;
use Tigren\Testimonial\Model\TestimonialFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /**
     * Testimonial Factory
     * @var TestimonialFactory
     */
    private $testimonialFactory;

    /**
     * Init
     * @param TestimonialFactory $testimonialFactory
     */
    public function __construct(TestimonialFactory $testimonialFactory)
    {
        $this->testimonialFactory = $testimonialFactory;
    }

    /**
     * {@inheritDoc}
     * @SuppressWarnings (PHPMD.ExcessiMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $testimonialData = [];
    }

    public function createTestimonial()
    {
        return $this->testimonialFactory->create();
    }
}
