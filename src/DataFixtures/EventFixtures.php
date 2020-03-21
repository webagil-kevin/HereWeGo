<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Register;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class EventFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // On créé 100 événements
        for ($i = 0; $i < 100; $i++) {
            $city = $manager->getRepository(\App\Entity\City::class)->find(random_int(1, 36500));
            $category = $manager->getRepository(\App\Entity\Category::class)->find(random_int(1, 2));
            $start = $faker->dateTimeInInterval($startDate = '-30 days', $interval = '+90 days', 'Europe/Paris');
            $end = $start->modify('+'.random_int(1, 72).' hours');

            $event = new Event();
            $event
                ->setTitle($faker->sentence($nbWords = 6, $variableNbWords = true))
                ->setCategory($category)
                ->setStart($start)
                ->setEnd($end)
                ->setAddress($faker->streetAddress)
                ->setCity($city)
                ->setLat(null)
                ->setLng(null)
                ->setPhone($faker->isbn10)
                ->setWebsite('https://'.$faker->domainName)
                ->setDescription($faker->paragraph($nbSentences = 4, $variableNbSentences = true))
                ->setLabel(strtoupper(substr($faker->uuid, 1, 5)))
                ->setCreated($faker->dateTimeThisDecade('now', 'Europe/Paris'))
                ->setUpdated($faker->dateTimeThisDecade('now', 'Europe/Paris'))
            ;

            // Inscription à l'événement d'un nombre aléatoire de membres (entre 1 et 10)
            /*
             * Ne fonctionne pas, il faut passer par \App\Entity\Register
             *
            for ($m = 0, $mMax = random_int(1, 10); $m < $mMax; $m++) {
                $member = $manager->getRepository(\App\Entity\User::class)->find(random_int(1, 300));
                $event->addRegister($member);
            }
            */

            $manager->persist($event);

            // On envoie régulièrement en BDD pour ne pas saturer le cache
            if (($i % 20) === 0) {
                $manager->flush();
                $manager->clear(); // Detaches all objects from Doctrine!
            }
        }
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CityFixtures::class,
            CategoryFixtures::class,
            UserFixtures::class,
        );
    }
}
