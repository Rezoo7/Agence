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
        return $this->render('home/index.html.twig', [
            'properties' => $properties,
            'controller_name' => "Maxime"

        ]);
    }

    /**
     * @Route("/graphs", name="graphs")
     * @param PropertyRepository $repository
     * @return Response
     */
    public function graphs(PropertyRepository $repository){

        $properties_sold = $repository->findSoldProperties();
        $properties_notSold = $repository->findNotSoldProperties();
        $properties = $repository->findAllQuery();
        $somme = 0;
        $total = 0;

        foreach ($properties_sold as $p){
            $somme = $somme + $p->getPrice();
            $total = $total+1;
        }

        return $this->render('home/graph.html.twig', [
            'total_sold' => $somme,
            'total_properties_notSold' =>$total,
            'properties_notSold' => $properties_notSold,
            'properties_sold' => $properties_sold,
            'properties' => $properties,
            'current_menu' => 'graphs'
        ]);

    }

}
