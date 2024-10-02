<?php

namespace Tigren\SimpleBlog\Ui\Category;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Directory\ReadInterface;
use Magento\Framework\Filesystem\Driver\File\Mime;
use Magento\Store\Model\StoreManagerInterface;
use Tigren\SimpleBlog\Model\Post;
use Tigren\SimpleBlog\Model\ResourceModel\Category\CollectionFactory;
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
        }
        return $this->_loadedData;
    }
}
