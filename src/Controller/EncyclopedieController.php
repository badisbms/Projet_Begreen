<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlantRepository;

/**
 * @Route("/encyclopedie")
 */

class EncyclopedieController extends AbstractController
{
    /**
     * @Route("/", name="encyclopedie", name="encyclopedie_index", methods={"GET"})
     */
    public function index(PlantRepository $plantRepository): Response
    {
        return $this->render('encyclopedie/index.html.twig', [
            'plants' => $plantRepository->findAll(),
        ]);
    }

  
}
