<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Controller;

use App\Model\ProductAttributeValueInterface;
use App\Uploader\AttributeValueUploaderInterface;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ProductDocumentController
 *
 * @author Philippe Vesin <pve.asdoria@gmail.com>
 */
class ProductDocumentController extends ResourceController
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function downloadAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
        $resource = $this->findOr404($configuration);
        $uploader = $this->get('asdoria_product_document.media.document_uploader');
        $info     = pathinfo($resource->getPath());
        $basename = $info['basename'];
        $prefix   = $request->query->has('download') ? 'attachment; ' : '';

        $options = array(
            'Content-Type'        => ($info['extension'] === 'pdf') ? 'application/pdf' : 'image/' . $info['extension'],
            'Content-Disposition' => $prefix . 'filename="' . $basename . '"'
        );

        $content = $uploader->getContent($resource);

        return new Response(
            $content, 200, $options
        );
    }
}
