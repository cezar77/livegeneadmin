<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use App\Entity\Staff;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;

class StaffController extends FOSRestController
{
    /**
     * Retrieve a collection of Staff resource
     * @Rest\Get("/people")
     * @QueryParam(name="homeProgram", requirements="\w+", strict=true, nullable=true,
     *     description="Retrieve all staff for the given home program")
     */
    public function getPeople(ParamFetcher $paramFetcher): View
    {
        $repository = $this->getDoctrine()->getRepository(Staff::class);
        
        $criteria = $paramFetcher->all();

        foreach ($criteria as $key => $value) {
            if (is_null($value)) {
                unset($criteria[$key]);
            }
        }

        if ($criteria) {
            $data = $repository->findBy($criteria);
        } else {
            $data = $repository->findAll();
        }
    
        return View::create($data, Response::HTTP_OK);
    }

    /**
     * Retrieve a Staff resource
     * @Rest\Get("/people/{username}")
     */
    public function getPerson(string $username): View
    {
        $repository = $this->getDoctrine()->getRepository(Staff::class);
        
        $data = $repository->findByUsername($username);

        if (!$data) {
            throw new EntityNotFoundException('Staff with username '.$username.' does not exist!');
        }
    
        return View::create($data, Response::HTTP_OK);
    }
}
