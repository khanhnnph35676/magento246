<?php

namespace Tigren\Testimonial\Model;
class Mapper
{
    public $map;
    public $map1;
    protected $_orderCollectionFactory;
    protected $orderRepository;

    public function __construct(
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Magento\Sales\Api\OrderRepositoryInterface                $orderRepository
    )
    {
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->orderRepository = $orderRepository;
        $this->map = $this->makeMap();
        $this->map1 = $this->makeMapItem();
    }

    private function makeMap()
    {
        if ($this->map == null) {
            $this->map = $this->buildMap();
        }
        return $this->map;
    }

    private function makeMapItem()
    {
        if ($this->map1 == null) {
            $this->map1 = $this->buildMapItems();
        }
        return $this->map1;
    }

    private function buildMap()
    {
        $order = $this->_orderCollectionFactory->create()
            ->addAttributeToSelect('*');
        $items = [];
        $options = [];
        $result = [];
        foreach ($order->getData() as $attribute) {
            if ($attribute['customer_id'] != '') {
                $result[$attribute['customer_id']][] = [
                    'label' => $attribute['increment_id'], 'value' => $attribute['increment_id'],
                ];
            }
        }
        return $result;
    }

    private function buildMapItems()
    {
        $result = [];
        $orderCollection = $this->_orderCollectionFactory->create()
            ->addAttributeToSelect('*');
        foreach ($orderCollection as $attribute) {
            if ($attribute->getCustomerId() != '') {
                $order_id = $attribute->getIncrementId();
                $order_data = $this->orderRepository->get($order_id);
                if (!empty($order_data)) {
                    foreach ($order_data->getAllItems() as $value) {
                        $result[$order_id][] = [
                            'label' => $value->getName(), 'value' => $value->getProductId(),
                        ];
                    }
                }
            }
        }
        return $result;
    }
}
