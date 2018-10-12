<?php

namespace App\Controller;


use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use App\Entity\SamplingActivity;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;

class SamplingActivityController extends FOSRestController
{
    /**
     * Retrieves a collection of SamplingActivity resource
     * @Rest\Get("/samplingactivities")
     */
    public function getSamplingActivities(ParamFetcher $paramFetcher): View
    {
        $repository = $this->getDoctrine()->getRepository(SamplingActivity::class);

        #$criteria = $paramFetcher->all();

        #foreach ($criteria as $key => $value) {
        #    if (is_null($value)) {
        #        unset($criteria[$key]);
        #    }
        #}

        #if ($criteria) {
        #    $data = $repository->findBy($criteria);
        #} else {
            $data = $repository->findAll();
        #}

        return View::create($data, Response::HTTP_OK);
    }
    /**
     * Retrieve a SamplingActivity resource
     * @Rest\Get("/samplingactivities/{id}")
     */
    public function getSamplingActivity($id)
    {
        $repository = $this->getDoctrine()->getRepository(SamplingActivity::class);

        $data = $repository->find($id);

        if (!$data) {
            throw new EntityNotFoundException('Sampling activity with ID '.$id.' does not exist!');
        }

        return View::create($data, Response::HTTP_OK);
    }
}
