<?php
declare(strict_types=1);
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

namespace Tigren\HidePrice\Plugin\Catalog\Product;

use Psr\Log\LoggerInterface;
use Magento\Customer\Model\SessionFactory;

class View
{
    protected $sessionFactory;
    protected $logger;

    public function __construct(SessionFactory $sessionFactory, LoggerInterface $logger)
    {
        $this->sessionFactory = $sessionFactory;
        $this->logger = $logger;
    }

    public function beforeToHtml(\Magento\Catalog\Block\Product\View $subject)
    {
        $session = $this->sessionFactory->create();
        $this->logger->info('HidePrice Plugin view');
        $this->logger->info('Customer logged in: ' . ($session->isLoggedIn() ? $session->isLoggedIn() : 'No'));

        if (!$session->isLoggedIn()) {
            $subject->setTemplate('Tigren_HidePrice::product/view/no_price.phtml');
        }
    }
}
