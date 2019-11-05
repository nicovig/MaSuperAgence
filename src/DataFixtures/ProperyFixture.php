<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ProperyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i= 0; $i<100; $i++){
            $property = new Property();

            $property->setTitle($faker->words(3, true))
                ->setPostalCode($faker->postcode)
                ->setAddress($faker->address)
                ->setCity($faker->city)
                ->setHeat($faker->numberBetween(0,1))
                ->setPrice($faker->numberBetween(80000, 500000))
                ->setFloor($faker->numberBetween(0,15))
                ->setBedrooms($faker->numberBetween(1, 4))
                ->setRooms($faker->numberBetween(2, 10))
                ->setSurface($faker->numberBetween(20, 200))
                ->setDescription($faker->sentences(3, true))
                ->setSold(false);

            $manager->persist($property);

        }
        $manager->flush();
    }
}
