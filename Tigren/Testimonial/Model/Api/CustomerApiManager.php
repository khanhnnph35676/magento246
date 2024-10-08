<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */


namespace Tigren\Testimonial\Model\Api;

class CustomerApiManager implements \Tigren\Testimonial\Api\CustomerManagerInterface
{
    protected $_testApiFactory;

    public function __construct(
        \Tigren\Testimonial\Model\CustomerApiFactory $testApiFactory

    )
    {
        $this->_testApiFactory = $testApiFactory;
    }

    /**
     * get test Api data.
     *
     * @param int $id
     *
     * @return \Tigren\Testimonial\Api\Data\CustomerApiInterface
     * @api
     *
     */
    public function getApiData($id)
    {
        try {
            $model = $this->_testApiFactory->create();
            $model->setId($id);
            if (!$model->getId()) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('no data found')
                );
            }

            return $model;
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            // Handle exception for localized error
            throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
        } catch (\Exception $e) {
            // Handle generic exception
            throw new \Magento\Framework\Exception\LocalizedException(__('Unable to process the request.'));
        }
    }
}
