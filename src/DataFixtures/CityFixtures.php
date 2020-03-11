<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CityFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $csv = fopen(__DIR__ .'/ressources/cities.csv', 'r');

        $i = 0;
        $batchSize = 20;

        while (!feof($csv)) {
            $line = fgetcsv($csv, 1000, ';', '"');

            $city[$i] = new City();
            $city[$i]->setName($line[0]);
            $city[$i]->setCp($line[1]);
            $city[$i]->setLat($line[2]);
            $city[$i]->setLng($line[3]);

            $manager->persist($city[$i]);
            if (($i % $batchSize) === 0) {
                $manager->flush();
                $manager->clear(); // Detaches all objects from Doctrine!
            }

            $i++;
        }

        fclose($csv);

        $manager->flush();
        $manager->clear();
    }
}
