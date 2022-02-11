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

use Asdoria\SyliusProductDocumentPlugin\Uploader\UploaderInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Liip\ImagineBundle\Imagine\Filter\FilterManager;

/**
 * Class RemoveListener
 * @package Asdoria\Bundle\MediaBundle\EventListener
 */
class RemoveListener
{
    /** @var UploaderInterface */
    protected $uploader;

    /**
     * ImagesRemoveListener constructor.
     *
     * @param UploaderInterface $uploader
     */
    public function __construct(UploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @param LifecycleEventArgs $event
     */
    public function postRemove(LifecycleEventArgs $event): void
    {
        $entity = $event->getEntity();

        if ($entity instanceof DocumentInterface) {
            $this->uploader->remove($entity->getPath());
        }
    }
}
