<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlantRepository;
use App\Repository\ImagesRepository;
use App\Entity\Plant;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/encyclopedie")
 */

class EncyclopedieController extends AbstractController
{
    /**
     * @Route("/", name="encyclopedie", name="encyclopedie_index", methods={"GET"})
     */
    public function index(Request $request, PlantRepository $plantRepository, PaginatorInterface $paginator): Response
    {

        $donnees = $this->getDoctrine()->getRepository(Plant::class)->findBy([],['id' => 'ASC']);

        $plants = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            12 // Nombre de résultats par page
        );

        return $this->render('encyclopedie/index.html.twig', [
            'plants' => $plants,
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
