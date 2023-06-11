<?php

namespace App\DataFixtures;

use App\Entity\Car;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class CarFixtures extends Fixture implements DependentFixtureInterface
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 40; $i++) {
            $car = new Car();
            $category = $faker->randomElement(CarCategoryFixtures::CATEGORIES);
            $car->setCategory($this->getReference('category_' . $this->slugger->slug($category)->lower()))
                ->setNbDoors($faker->numberBetween(2, 5))
                ->setNbSeats($faker->numberBetween(2, 6))
                ->setName($faker->word())
                ->SetCost($faker->randomFloat(2, 10000, 45000))
                ->SetImage($faker->randomElement([
                    'https://static3.depositphotos.com/1000159/100/i/450/depositphotos_1008200-stock-photo-empty.jpg',
                    'https://us.123rf.com/450wm/eraxion/eraxion1402/eraxion140200003/25820088-illustration-d-une-berline-sport-de-concept.jpg?ver=6',
                    'https://media.istockphoto.com/id/959391798/fr/photo/illustration-3d-de-suv-compact-g%C3%A9n%C3%A9rique-blanc.jpg?s=612x612&w=0&k=20&c=56-eOEokCqQxt6Gll4m6qNFaldVpYtTNjuUEAbDDaAc=',
                ]));
            $manager->persist($car);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CarCategoryFixtures::class,
        ];
    }
}
