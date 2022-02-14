<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Traits;

/**
 * Trait ResourceTrait
 * @package Asdoria\SyliusProductDocumentPlugin\Traits
 */
trait ResourceTrait
{
    /**
     * @var int|null
     */
    protected $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
