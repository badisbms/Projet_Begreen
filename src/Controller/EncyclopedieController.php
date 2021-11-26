<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlantRepository;
use App\Repository\ImagesRepository;
use App\Entity\Plant;

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

    /**
     * @Route("/{id}", name="encyclopedie_show", methods={"GET"})
     */
    public function show(int $id,ImagesRepository $imagesRepository, Plant $plant): Response
    {
        return $this->render('encyclopedie/detailPlant.html.twig', [
            'plant' => $plant,
            //permet de récupérer les images associé en BDD a l'image grace a l'id
            'image' => $imagesRepository->findByExampleField($id),
        ]);
    }

  
}
