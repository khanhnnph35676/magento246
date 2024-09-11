<?php

namespace Tigren\Testimonial\Ui\Testimonial;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Directory\ReadInterface;
use Magento\Framework\Filesystem\Driver\File\Mime;
use Magento\Store\Model\StoreManagerInterface;
use Tigren\Testimonial\Model\TestimonialFactory;
use Tigren\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected $_loadedData;
    protected $collection;
    private ReadInterface $mediaDirectory;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param StoreManagerInterface $storeManager
     * @param Filesystem $filesystem
     * @param Mime $mime
     * @param array $meta
     * @param array $data
     * @throws FileSystemException
     */
    public function __construct(
        string                                 $name,
        string                                 $primaryFieldName,
        string                                 $requestFieldName,
        CollectionFactory                      $collectionFactory,
        private readonly StoreManagerInterface $storeManager,
        private readonly Filesystem            $filesystem,
        private readonly Mime                  $mime,
        array                                  $meta = [],
        array                                  $data = []
    )
    {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->mediaDirectory = $this->filesystem->getDirectoryWrite(DirectoryList::MEDIA);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $item) {
            $this->_loadedData[$item->getId()] = $item->getData();
            $image = isset($item['profile_image']) ? $item['profile_image'] : null;
            $data = $item->getData();
            if (isset($image)) {
                if (!$image) {
                    $this->_loadedData[$item->getId()] = $data;
                    return $this->_loadedData;
                }
                $imgPath = 'testimonials/profile_image';
                $baseUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
                $imageUrl = $baseUrl . $imgPath . '/' . $image;
                $fullImagePath = $this->mediaDirectory->getAbsolutePath($imgPath) . '/' . $image;

                $stat = $this->mediaDirectory->stat($fullImagePath);
                $data['profile_image'] = null;
                $data['profile_image'][0]['url'] = $imageUrl;
                $data['profile_image'][0]['name'] = $image;
                $data['profile_image'][0]['size'] = $stat['size'];
                $data['profile_image'][0]['type'] = $this->mime->getMimeType($fullImagePath);
//                    $fullData = $this->_loadedData;
                $this->_loadedData[$item->getId()] = $data;
            }
        }
        return $this->_loadedData;
    }
}
