<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\EventListener;

//TODO fix mediabundle call
use Asdoria\Bundle\MediaBundle\Uploader\UploaderInterface;
use Asdoria\SyliusProductDocumentPlugin\Model\Aware\ProductDocumentsAwareInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

/**
 * Class ProductDocumentsUploadListener
 * @package Asdoria\SyliusProductDocumentPlugin\EventListener
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
class ProductDocumentsUploadListener
{
    /**
     * @var UploaderInterface
     */
    protected $uploader;

    /**
     * ProductDocumentUploadListener constructor.
     *
     * @param UploaderInterface $uploader
     */
    public function __construct(UploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @param GenericEvent $event
     */
    public function uploadDocuments(GenericEvent $event): void
    {
        $subject = $event->getSubject();
        Assert::isInstanceOf($subject, ProductDocumentsAwareInterface::class);

        $this->uploadSubjectDocuments($subject);
    }

    /**
     * @param ProductDocumentsAwareInterface $subject
     */
    private function uploadSubjectDocuments(ProductDocumentsAwareInterface $subject): void
    {
        $documents = $subject->getProductDocuments();
        foreach ($documents as $document) {
            if ($document->hasFile()) {
                $this->uploader->upload($document);
            }

            // Upload failed? Let's remove that image.
            if (null === $document->getPath()) {
                $documents->removeElement($document);
            }
        }
    }
}
