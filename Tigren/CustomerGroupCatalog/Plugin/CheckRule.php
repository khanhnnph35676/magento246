<?php
declare(strict_types=1);
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

namespace Tigren\CustomerGroupCatalog\Plugin;

use Psr\Log\LoggerInterface;
use Magento\Customer\Model\SessionFactory;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\HistoryRule\CollectionFactory;

class CheckRule
{
    protected $ruleHistoryColFactory;
    protected $sessionFactory;
    protected $logger;

    public function __construct(SessionFactory    $sessionFactory,
                                LoggerInterface   $logger,
                                CollectionFactory $ruleHistoryColFactory
    )
    {
        $this->sessionFactory = $sessionFactory;
        $this->logger = $logger;
        $this->ruleHistoryColFactory = $ruleHistoryColFactory;
    }

    public function aroundGetRuleItem(\Tigren\CustomerGroupCatalog\Block\RuleList $subject, \Closure $proceed)
    {
        $session = $this->sessionFactory->create();
        $ruleCollection = $this->ruleHistoryColFactory->create();


        $this->logger->info('Check rule Plugin view');
        $this->logger->info('Customer logged in: ' . ($session->isLoggedIn() ? $session->getCustomerId() : 'No'));

        if (!$session->isLoggedIn()) {
            return null;
        }

        $customerId = $ruleCollection->getColumnValues('customer_id');
//        var_dump($customerId);
        foreach ($customerId as $value) {
            if ($value == $session->getCustomerId()) {
                return $proceed();
            }
        }
    }
}
