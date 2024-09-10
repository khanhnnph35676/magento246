<?php

namespace Tigren\Testimonial\Ui\Component\Listing\Column;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Data\OptionSourceInterface;
use Psr\Log\LoggerInterface;

class CustomerOptions implements OptionSourceInterface
{
    protected $customerRepository;
    protected $searchCriteriaBuilder;
    protected $logger;

    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        SearchCriteriaBuilder       $searchCriteriaBuilder,
        LoggerInterface             $logger
    )
    {
        $this->customerRepository = $customerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->logger = $logger;
    }

    public function toOptionArray()
    {
        $this->logger->debug('CustomerOptions: Fetching all customers.');

        $searchCriteria = $this->searchCriteriaBuilder->create();
        $customers = $this->customerRepository->getList($searchCriteria)->getItems();
//        var_dump($customers);
//        dd();
        $options = [];
        foreach ($customers as $customer) {
            $options[] = [
                'value' => $customer->getId(),
                'label' => $customer->getFirstname() . ' ' . $customer->getLastname(),
            ];
        }
        $this->logger->debug('CustomerOptions: Options fetched: ' . print_r($options, true));
        return $options;
    }
}


