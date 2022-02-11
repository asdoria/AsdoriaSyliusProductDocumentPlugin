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


namespace Asdoria\SyliusProductDocumentPlugin\Model;

use Doctrine\Common\Collections\Collection;

/**
 * Interface DocumentsAwareInterface
 * @package Asdoria\Bundle\MediaBundle\Model
 */
interface DocumentsAwareInterface
{
    /**
     * @return Collection|DocumentInterface[]
     */
    public function getDocuments(): Collection;

    /**
     * @param string $type
     *
     * @return Collection|DocumentInterface[]
     */
    public function getDocumentsByType(string $type): Collection;

    /**
     * @return bool
     */
    public function hasDocuments(): bool;

    /**
     * @param DocumentInterface $document
     *
     * @return bool
     */
    public function hasDocument(DocumentInterface $document): bool;

    /**
     * @param DocumentInterface $document
     */
    public function addDocument(DocumentInterface $document): void;

    /**
     * @param DocumentInterface $document
     */
    public function removeDocument(DocumentInterface $document): void;
}
