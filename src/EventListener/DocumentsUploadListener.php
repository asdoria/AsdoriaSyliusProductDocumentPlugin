<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\EventListener;

use Asdoria\SyliusProductDocumentPlugin\Model\DocumentsAwareInterface;
use Asdoria\SyliusProductDocumentPlugin\Uploader\UploaderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

/**
 * Class DocumentsUploadListener
 * @package Asdoria\SyliusProductDocumentPlugin\EventListener
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class DocumentsUploadListener
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
    public function uploadDocuments(GenericEvent $event): void
    {
        $subject = $event->getSubject();
        Assert::isInstanceOf($subject, DocumentsAwareInterface::class);

        $this->uploadSubjectDocuments($subject);
    }

    /**
     * @param DocumentsAwareInterface $subject
     */
    private function uploadSubjectDocuments(DocumentsAwareInterface $subject): void
    {
        $documents = $subject->getDocuments();
        foreach ($documents as $document) {
            if ($document->hasFile()) {
                $this->uploader->upload($document);
            }

            // Upload failed? Let's remove that document.
            if (null === $document->getPath()) {
                $documents->removeElement($document);
            }
        }
    }
}
