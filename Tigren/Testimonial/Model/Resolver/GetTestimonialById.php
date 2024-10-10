<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */
declare(strict_types=1);

namespace Tigren\Testimonial\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Tigren\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class GetTestimonialById implements ResolverInterface
{
    /**
     * @var CollectionFactory
     */
    private $testimonialCollectionFactory;

    /**
     * @param CollectionFactory $testimonialCollectionFactory
     */
    public function __construct(
        CollectionFactory $testimonialCollectionFactory
    )
    {
        $this->testimonialCollectionFactory = $testimonialCollectionFactory;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field       $field,
                    $context,
        ResolveInfo $info,
        array       $value = null,
        array       $args = null
    )
    {
        $testimonialId = $args['id'];
        $collection = $this->testimonialCollectionFactory->create();
        $testimonial = $collection->getItemById($testimonialId);

        if (!$testimonial) {
            throw new NoSuchEntityException(__('Testimonial with ID "%1" does not exist.', $testimonialId));
        }

        return [
            'entity_id' => $testimonial->getEntityId(),
            'customer_id' => $testimonial->getCustomerId(),
            'name' => $testimonial->getName(),
            'email' => $testimonial->getEmail(),
            'message' => $testimonial->getMessage(),
            'company' => $testimonial->getCompany(),
            'rating' => $testimonial->getRating(),
            'profile_image' => $testimonial->getProfileImage(),
            'status' => $testimonial->getStatus(),
            'created_at' => $testimonial->getCreatedAt(),
        ];
    }
}
