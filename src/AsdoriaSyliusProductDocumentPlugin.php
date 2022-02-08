<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class AsdoriaProductDocumentBundle
 * @package Asdoria\Bundle\ProductDocumentBundle
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
class AsdoriaSyliusProductDocumentPlugin extends Bundle
{
    use SyliusPluginTrait;

}
