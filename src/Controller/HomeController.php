<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param PropertyRepository $repository
     * @return Response
     */
    public function index(PropertyRepository $repository)
    {
        $properties = $repository->findLatest();
        dump($properties);
        return $this->render('home/index.html.twig', [
            'properties' => $properties,
            'controller_name' => "Maxime"

        ]);
    }
}
