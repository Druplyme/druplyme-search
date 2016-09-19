<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @Route("/api/v1.0/search", name="search")
     */
    public function indexAction(Request $request)
    {
        $projects = $this->get('app.search')->find($request->query);

        $result = array_map(function ($project) {
            /** @var $project Project */
            return $project->toArray();
        }, $projects);

        return new JsonResponse($result);
    }
}
