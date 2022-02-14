<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Model;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

/**
 * Interface PictogramTranslationInterface
 * @package Asdoria\SyliusProductDocumentPlugin\Model
 */
interface DocumentTypeTranslationInterface extends ResourceInterface, TranslationInterface
{
    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void;
}
