<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Traits;

/**
 * Class SortableTrait
 * @package Asdoria\SyliusProductDocumentPlugin\Traits
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
trait SortableTrait
{
    /**
     * @var int|null
     */
    protected ?int $position = 0;

    /**
     * @return int
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @param int|null $position
     */
    public function setPosition(?int $position): void
    {
        $this->position = $position;
    }
}
