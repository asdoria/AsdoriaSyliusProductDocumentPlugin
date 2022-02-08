<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Twig;

use Asdoria\SyliusProductDocumentPlugin\Helper\WebPathHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class DocumentExtension
 * @package Asdoria\SyliusProductDocumentPlugin\Twig
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
class DocumentExtension extends AbstractExtension
{
    /**
     * @var WebPathHelper
     */
    protected $webPathHelper;

    /**
     * DocumentExtension constructor.
     *
     * @param WebPathHelper $webPathHelper
     */
    public function __construct(WebPathHelper $webPathHelper)
    {
        $this->webPathHelper = $webPathHelper;
    }

    /**
     * @return array|TwigFilter[]
     */
    public function getFilters()
    {
        return [
            new TwigFilter('getDocumentPath', [$this->webPathHelper, 'getPublicPath'])
        ];
    }
}
