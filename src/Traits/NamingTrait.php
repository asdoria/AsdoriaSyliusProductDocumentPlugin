<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Traits;

/**
 * Class NamingTrait
 * @package Asdoria\SyliusProductDocumentPlugin\Traits
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
trait NamingTrait
{
    /**
     * @var string|null
     */
    protected ?string $name =null;

    /**
     * @return string|null
     */
    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}
