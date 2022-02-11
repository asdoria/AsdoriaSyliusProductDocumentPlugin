<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\EventListener;

use Asdoria\SyliusProductDocumentPlugin\Model\DocumentAwareInterface;
use Asdoria\SyliusProductDocumentPlugin\Model\DocumentInterface;
use Asdoria\SyliusProductDocumentPlugin\Uploader\UploaderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

/**
 * Class DocumentUploadListener
 *
 * @package AppBundle\EventListener
 */
class DocumentUploadListener
{
    /**
     * @var UploaderInterface
     */
    private $uploader;

    /**
     * @param UploaderInterface $uploader
     */
    public function __construct(UploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @param GenericEvent $event
     */
    public function uploadDocument(GenericEvent $event) {
        $subject = $event->getSubject();
        Assert::isInstanceOf($subject, DocumentAwareInterface::class);
        $this->uploadSubjectDocument($subject->getDocument());
    }

    /**
     * @param DocumentInterface $subject
     */
    private function uploadSubjectDocument(DocumentInterface $subject): void
    {
        $document = $subject;
        if ($document->hasFile()) {
            $this->uploader->upload($document);
        }
    }

}
