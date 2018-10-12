<?php

namespace App\Controller;


use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use App\Entity\SamplingDocumentation;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;

class SamplingDocumentationController extends FOSRestController
{
    /**
     * Retrieve a collection of SamplingDocumentation resource
     * @Rest\Get("/samplingdocumentations")
     * @QueryParam(name="samplingDocumentType", key="document_type", requirements="\w+", strict=true, nullable=true,
     *     description="Retrieve all documentations for the given document type")
     */
    public function getSamplingDocumentations(ParamFetcher $paramFetcher): View
    {
        $repository = $this->getDoctrine()->getRepository(SamplingDocumentation::class);

        $documentType = $paramFetcher->get('samplingDocumentType');

        if ($documentType) {
            $data = $repository->findBySamplingDocumentationType($documentType);
        } else {
           $data = $repository->findAll();
        }

        return View::create($data, Response::HTTP_OK);
    }
    /**
     * Retrieve a SamplingDocumentation resource
     * @Rest\Get("/samplingdocumentations/{id}")
     */
    public function getSamplingDocumentation($id)
    {
        $repository = $this->getDoctrine()->getRepository(SamplingDocumentation::class);

        $data = $repository->find($id);

        if (!$data) {
            throw new EntityNotFoundException('Sampling document with ID '.$id.' does not exist!');
        }

        return View::create($data, Response::HTTP_OK);
    }
}
