<?php

namespace Tigren\SimpleBlog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Directory\WriteInterface;
use Magento\Framework\UrlInterface;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Store\Model\StoreManagerInterface;

class Upload extends Action implements HttpPostActionInterface
{
    private WriteInterface $mediaDirectory;

    public function __construct(
        Action\Context                $context,
        Filesystem                    $filesystem,
        private UploaderFactory       $uploaderFactory,
        private StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context);
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
    }

    public function execute(): ResultInterface
    {
        $jsonResult = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        try {
            // Tạo đối tượng file uploader
            $fileUploader = $this->uploaderFactory->create(['fileId' => 'post_image']);
            $fileUploader->setAllowedExtensions(['jpg', 'jpeg', 'png']);
            $fileUploader->setAllowRenameFiles(true);
            $fileUploader->setAllowCreateFolders(true);
            $fileUploader->setFilesDispersion(false);
            $imgPath = 'testimonials/post_image';
            // Kiểm tra và tạo thư mục nếu chưa tồn tại
            $this->mediaDirectory->create($imgPath);
            // Lưu ảnh vào thư mục
            $result = $fileUploader->save($this->mediaDirectory->getAbsolutePath($imgPath));

            // Lấy URL ảnh
            $mediaUrl = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
            $fileName = ltrim(str_replace('\\', '/', $result['file']), '/');
            $result['url'] = $mediaUrl . $imgPath . '/' . $fileName;

            return $jsonResult->setData($result);
        } catch (LocalizedException $e) {
            return $jsonResult
                ->setData(['errorcode' => 0, 'error' => $e->getMessage()]);
        } catch (\Exception $e) {
            return $jsonResult
                ->setData(['errorcode' => 1, 'error' => __('An error occurred while uploading testimonials. Please try again.')]);
        }
    }
}
