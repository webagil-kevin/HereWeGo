<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $catList = [
            ['Sports', '#c7eb14', '	fas fa-futbol'],
            ['Musique', '#FA3268', 'fas fa-user'],
        ];

        foreach($catList AS $k => $catArray) {
            $category = new Category();
            $category->setTitle($catArray[0]);
            $category->setColor($catArray[0]);
            $category->setIcon($catArray[0]);

            $manager->persist($category);
        }

        $manager->flush();
    }
}
