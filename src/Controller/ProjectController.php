<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use App\Entity\Project;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;

class ProjectController extends FOSRestController
{
    /**
     * Retrieves a collection of Project resource
     * @Rest\Get("/projects")
     * @QueryParam(map=true, name="ilriCode", requirements="\w+", strict=true, nullable=true,
     *     description="Retrieves all projects for the given ILRI codes")
     * @QueryParam(name="projectsGroup", key="projects_group", requirements="\w+", strict=true, nullable=true,
     *     description="Retrieves all projects for the given project's group")
     */
    public function getProjects(ParamFetcher $paramFetcher): View
    {
        $repository = $this->getDoctrine()->getRepository(Project::class);

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
