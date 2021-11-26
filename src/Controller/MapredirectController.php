<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MapredirectController extends AbstractController
{
    /**
     * @Route("/mapredirect", name="mapredirect")
     */
    public function index(): RedirectResponse
    
    {
  
    // redirects externally
    return $this->redirect('https://www.google.com/maps/d/edit?mid=1KPOK-Xct6HaB7aOfBcpdCGvdi6BV5MtL&usp=sharing');
    }
}
