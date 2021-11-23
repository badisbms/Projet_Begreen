<?php

namespace App\Controller;

use App\Entity\Plant;
use App\Form\PlantType;
use App\Entity\Images;
use App\Repository\PlantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/plant")
 */
class PlantController extends AbstractController
{
    /**
     * @Route("/", name="plant_index", methods={"GET"})
     */
    public function index(PlantRepository $plantRepository): Response
    {
        return $this->render('plant/index.html.twig', [
            'plants' => $plantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="plant_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plant = new Plant();
        $form = $this->createForm(PlantType::class, $plant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //recup images transmises 
            $images = $form->get('images')->getData();
            $photos = $form->get('photos')->getData();

            //multiple doncboucle sur les images 
            // foreach ($images as $image) {
                // genere new fichier
                $fichier = md5(uniqid()) . '.' . $images->guessExtension();
                //copie le fichier dans le dossier uploads
                $images->move(
                    //destination
                    $this->getParameter('images_directory'),
                    $fichier
                );
                //stock img dans BDD (son nom)
                $img = new Images();
                $img->setName($fichier);
                //addphoto proviens de l'entité plant
                $plant->addImage($img);
            // }

            //multiple doncboucle sur les images 
            // foreach ($photos as $photo) {
                // genere new fichier

                if ($photos) {
                    $fichier2 = md5(uniqid()) . '.' . $photos->guessExtension();
                //copie le fichier dans le dossier uploads
                $photos->move(
                    //destination
                    $this->getParameter('photos_directory'),
                    $fichier2
                );
                //stock img dans BDD (son nom)
                $img2 = new Images();
                $img2->setName($fichier2);
                //addphoto proviens de l'entité plant
                $plant->addImage($img2);
            }

            $entityManager->persist($plant);
            $entityManager->flush();

            return $this->redirectToRoute('plant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plant/new.html.twig', [
            'plant' => $plant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="plant_show", methods={"GET"})
     */
    public function show(Plant $plant): Response
    {
        return $this->render('plant/show.html.twig', [
            'plant' => $plant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="plant_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Plant $plant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlantType::class, $plant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('plant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plant/edit.html.twig', [
            'plant' => $plant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="plant_delete", methods={"POST"})
     */
    public function delete(Request $request, Plant $plant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plant->getId(), $request->request->get('_token'))) {
            $entityManager->remove($plant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('plant_index', [], Response::HTTP_SEE_OTHER);
    }
}
