<?php

namespace Tigren\Testimonial\Model\Config\Backend;

use Magento\Framework\App\Config\Value;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Cache\Frontend\Pool;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Module\StatusFactory;

class EnableModule extends Value
{
    protected $statusFactory;

    public function __construct(
        StatusFactory                                      $statusFactory,
        TypeListInterface                                  $cacheTypeList,
        Pool                                               $cacheFrontendPool,
        \Magento\Framework\Model\Context                   $context,
        \Magento\Framework\Registry                        $registry,
        \Magento\Framework\App\Config\ScopeConfigInterface $config,
        \Magento\Framework\App\RequestInterface            $request
    )
    {
        $this->statusFactory = $statusFactory;
        parent::__construct($context, $registry, $config, $cacheTypeList);
    }

    public function beforeSave()
    {
        parent::beforeSave();

        $value = $this->getValue(); // Lấy giá trị từ hệ thống (Yes/No)
        $moduleName = 'Tigren_Testimonial'; // Tên module của bạn

        $moduleStatus = $this->statusFactory->create();
        try {
            if ($value) {
                $moduleStatus->setIsEnabled(true, [$moduleName]);
            } else {
                $moduleStatus->setIsEnabled(false, [$moduleName]);
            }
        } catch (LocalizedException $e) {
            throw new LocalizedException(__('Unable to change module status: ' . $e->getMessage()));
        }
    }
}


