<?php

namespace App\DataFixtures;

use App\Entity\Register;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RegisterFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $listEventUser = [];

        // On crée 1000 inscriptions à des événements
        for ($i = 0; $i < 1000; $i++) {

            // Chercher en boucle une nouvelle paire id/event non utilisée
            $continueSearch = true;
            while ($continueSearch === true) {
                $event = $manager->getRepository(\App\Entity\Event::class)->find(random_int(1, 100));
                $user = $manager->getRepository(\App\Entity\User::class)->find(random_int(12, 211));
                $aleatoryEventUser = ['event' => $event, 'user' => $user];

                if (!in_array(implode('-', $aleatoryEventUser), $listEventUser)) {
                    $listEventUser[] = $aleatoryEventUser;
                    $continueSearch = false;
                }
            }

            $register = new Register();
            $register
                ->setUser($aleatoryEventUser['user'])
                ->setEvent($aleatoryEventUser['event']);

            $manager->persist($register);

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
        return [
            EventFixtures::class,
            UserFixtures::class,
        ];
    }
}
