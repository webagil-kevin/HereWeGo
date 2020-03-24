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

        // On crée 100 événements
        for ($i = 0; $i < 100; $i++) {
            $city = $manager->getRepository(\App\Entity\City::class)->find(random_int(1, 36500));
            $category = $manager->getRepository(\App\Entity\Category::class)->find(random_int(1, 2));
            $user = $manager->getRepository(\App\Entity\User::class)->find(random_int(2, 10));
            $start = $faker->dateTimeInInterval($startDate = '-10 days', $interval = '+90 days', 'Europe/Paris');
            $end = $start->modify('+' . random_int(1, 72) . ' hours');

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
                ->setWebsite('https://' . $faker->domainName)
                ->setDescription($faker->paragraph($nbSentences = 4, $variableNbSentences = true))
                ->setLabel(strtoupper(substr($faker->uuid, 1, 5)))
                ->setUser($user)
                ->setCreated($faker->dateTimeThisDecade('now', 'Europe/Paris'))
                ->setUpdated($faker->dateTimeThisDecade('now', 'Europe/Paris'))
            ;

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
