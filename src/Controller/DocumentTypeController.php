<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Controller;

use App\Uploader\AttributeValueUploaderInterface;
use Asdoria\SyliusProductDocumentPlugin\Model\DocumentTypeInterface;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Component\Resource\ResourceActions;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class DocumentTypeController
 * @package Asdoria\SyliusProductDocumentPlugin\Controller
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class DocumentTypeController extends ResourceController
{    /**
 * @throws HttpException
 */
    public function updatePositionsAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
        $this->isGrantedOr403($configuration, ResourceActions::UPDATE);
        $documentTypesToUpdate = $request->get('documentTypes');

        if ($configuration->isCsrfProtectionEnabled() && !$this->isCsrfTokenValid('update-document-type-position', $request->request->get('_csrf_token'))) {
            throw new HttpException(Response::HTTP_FORBIDDEN, 'Invalid csrf token.');
        }

        if (in_array($request->getMethod(), ['POST', 'PUT', 'PATCH'], true) && null !== $documentTypesToUpdate) {
            foreach ($documentTypesToUpdate as $documentTypeToUpdate) {
                if (!is_numeric($documentTypeToUpdate['position'])) {
                    throw new HttpException(
                        Response::HTTP_NOT_ACCEPTABLE,
                        sprintf('The documentType position "%s" is invalid.', $documentTypeToUpdate['position'])
                    );
                }

                /** @var DocumentTypeInterface $documentType */
                $documentType = $this->repository->findOneBy(['id' => $documentTypeToUpdate['id']]);
                $documentType->setPosition((int) $documentTypeToUpdate['position']);
                $this->manager->flush();
            }
        }

        return new JsonResponse();
    }
}
