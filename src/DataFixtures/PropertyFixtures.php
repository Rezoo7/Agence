<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i =0;$i<100;$i++){
            $property = new Property();

            $ville = $faker->city;
            $rue = $faker->streetAddress;
            $postal_code = $faker->postcode;

            $property
                ->setTitle($ville . "  (" .$postal_code.")")
                ->setDescription($faker->sentences(3,true))
                ->setSurface($faker->numberBetween(20,350))
                ->setRooms($faker->numberBetween(2,10))
                ->setBedrooms($faker->numberBetween(1,9))
                ->setFloor($faker->numberBetween(0,15))
                ->setPrice($faker->numberBetween(100000,1000000))
                ->setHeat($faker->numberBetween(0,(count(Property::HEAT)-1 )))
                ->setCity($ville)
                ->setAddress($faker->address)
                ->setPostalCode($postal_code)
                ->setSold(false);

            $manager->persist($property);
        }
        $manager->flush(); //lancer fixture => doctrine:fixtures:load
    }
}
