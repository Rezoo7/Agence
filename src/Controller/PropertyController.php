<?php

namespace App\Controller;


use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/biens", name="property.index")
     */
    public function index()
    {
        $property = $this->repository->findAllVisible();

        dump($property);
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',

        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}",name="property.show",requirements={"slug": "[a-z0-9\-\_]*"})
     * @param Property $property, string $slug
     * @return Response
     */
    public function show(Property $property, string $slug): Response{

        if($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show',[
                'id' => $property->getId(),
                'slug'=> $property->getSlug()
            ],301);
        }
        return $this->render('property/show.html.twig',[
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }
}
