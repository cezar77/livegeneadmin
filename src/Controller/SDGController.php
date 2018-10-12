<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use App\Entity\SDG;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityNotFoundException;

class SDGController extends FOSRestController
{
    /**
     * Retrieve a collection of SDG resource
     * @Rest\Get("/sdgs")
     */
    public function getSDGs(): View
    {
        $repository = $this->getDoctrine()->getRepository(SDG::class);
        
        $data = $repository->findAll();
    
        return View::create($data, Response::HTTP_OK);
    }

    /**
     * Retrieve a SDG resource
     * @Rest\Get("/sdgs/{id}")
     */
    public function getSDG(int $id): View
    {
        $repository = $this->getDoctrine()->getRepository(SDG::class);
        
        $data = $repository->findById($id);

        if (!$data) {
            throw new EntityNotFoundException('SDG with id '.$id.' does not exist!');
        }
    
        return View::create($data, Response::HTTP_OK);
    }
}
