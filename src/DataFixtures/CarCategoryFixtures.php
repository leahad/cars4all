<?php

namespace App\DataFixtures;

use App\Entity\CarCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CarCategoryFixtures extends Fixture
{

    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    const CATEGORIES = [
        'A-segment mini cars',
        'B-segment small cars',
        'C-segment medium cars',
        'D-segment large cars',
        'E-segment executive cars',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORIES as $categoryName) {
            $carCategory = new CarCategory();
            $carCategory->setName($categoryName);
            $manager->persist($carCategory);
            $this->addReference('category_' . $this->slugger->slug($categoryName)->lower(), $carCategory);
        }
        $manager->flush();
    }
}
