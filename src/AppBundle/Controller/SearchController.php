<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @Route("/api/v1.0/search", name="search")
     */
    public function indexAction(Request $request)
    {
        $projects = $this->get('app.search')->find($request->query);
        $normalizedProjects = $this->get('serializer')->normalize($projects);

        return $this->json($normalizedProjects);
    }
}
