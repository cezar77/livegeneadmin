<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use App\Entity\Project;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityNotFoundException;

class ProjectController extends FOSRestController
{
    /**
     * Retrieves a collection of Project resource
     * @Rest\Get("/projects")
     */
    public function getProjects(): View
    {
        $repository = $this->getDoctrine()->getRepository(Project::class);

        $data = $repository->findAll();

        return View::create($data, Response::HTTP_OK);
    }

    /**
     * Retrieve a Project resource
     * @Rest\Get("/projects/{ilriCode}")
     */
    public function getProject($ilriCode): View
    {
        $repository = $this->getDoctrine()->getRepository(Project::class);

        $data = $repository->findByIlriCode($ilriCode);

        if (!$data) {
            throw new EntityNotFoundException('Project with ILRI code '.$ilriCode.' does not exist!');
        }

        return View::create($data, Response::HTTP_OK);
    }

}
