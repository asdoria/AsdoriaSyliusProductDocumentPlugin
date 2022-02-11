<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Entity;

use Asdoria\SyliusProductDocumentPlugin\Model\DocumentInterface;

/**
 * Class Document
 * @package Asdoria\SyliusProductDocumentPlugin\Entity
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
abstract class Document implements DocumentInterface
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var \SplFileInfo
     */
    protected $file;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var object
     */
    protected $owner;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getFile(): ?\SplFileInfo
    {
        return $this->file;
    }

    /**
     * {@inheritdoc}
     */
    public function setFile(?\SplFileInfo $file): void
    {
        $this->file = $file;
    }

    /**
     * {@inheritdoc}
     */
    public function hasFile(): bool
    {
        return null !== $this->file;
    }

    /**
     * {@inheritdoc}
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * {@inheritdoc}
     */
    public function setPath(?string $path): void
    {
        $this->path = $path;
    }

    /**
     * {@inheritdoc}
     */
    public function hasPath(): bool
    {
        return null !== $this->path;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner($owner): void
    {
        $this->owner = $owner;
    }
}
