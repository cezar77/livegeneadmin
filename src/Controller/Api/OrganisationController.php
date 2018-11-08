<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use App\Entity\Organisation;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;

class OrganisationController extends FOSRestController
{
    /**
     * Retrieve a collection of Organisation resources
     * @Rest\Get("/organisations")
     */
    public function getOrganisations(ParamFetcher $paramFetcher): View
    {
        $repository = $this->getDoctrine()->getRepository(Organisation::class);

        $data = $repository->findAll();

        return View::create($data, Response::HTTP_OK);
    }

    /**
     * Retrieve a collection of Organisations of type investor
     * @Rest\Get("/organisations/investors")
     */
    public function getActiveProjects(ParamFetcher $paramFetcher): View
    {
        $repository = $this->getDoctrine()->getRepository(Organisation::class);
        $data = $repository->findByPartnershipType();

        return View::create($data, Response::HTTP_OK);
    }

    /**
     * Retrieve an Organisation resource
     * @Rest\Get("/organisations/{id}")
     */
    public function getOrganisation($id): View
    {
        $repository = $this->getDoctrine()->getRepository(Organisation::class);

        $data = $repository->findById($id);

        if (!$data) {
            throw new EntityNotFoundException('Organisation with ID '.$id.' does not exist!');
        }

        return View::create($data, Response::HTTP_OK);
    }
}
