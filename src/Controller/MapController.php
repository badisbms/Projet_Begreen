<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function index(): Response
    {
        return $this->render('map/index.html.twig', [
            'controller_name' => 'MapController',
        ]);
    }
  

}
