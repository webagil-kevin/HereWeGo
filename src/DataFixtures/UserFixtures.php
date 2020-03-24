<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){

        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // On créé 1 admin
        $personne = new User();
        $personne
            ->setEmail('admin@herewego.test')
            ->setPassword($this->passwordEncoder->encodePassword($personne, 'password'))
            ->setRoles(['ROLE_ADMIN'])
            ->setFirstname($faker->firstName())
            ->setLastname($faker->lastName)
            ->setAddress($faker->streetAddress)
            ->setCity('')
            ->setPhone($faker->isbn10)
            ->setLat(null)
            ->setLng(null)
            ->setCreated($faker->dateTimeThisDecade('now', 'Europe/Paris'))
            ->setUpdated($faker->dateTimeThisDecade('now', 'Europe/Paris'));

        $manager->persist($personne);

        // On crée 9 organisateurs
        for ($i = 0; $i < 10; $i++) {
            $personne = new User();
            $personne
                ->setEmail('org' . $i . '@herewego.test')
                ->setPassword($this->passwordEncoder->encodePassword($personne, 'password'))
                ->setRoles(['ROLE_ORG'])
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName)
                ->setAddress($faker->streetAddress)
                ->setCity('')
                ->setPhone($faker->isbn10)
                ->setLat(null)
                ->setLng(null)
                ->setCreated($faker->dateTimeThisDecade('now', 'Europe/Paris'))
                ->setUpdated($faker->dateTimeThisDecade('now', 'Europe/Paris'));

            $manager->persist($personne);
        }

        // On crée 200 utilisateurs
        for ($i = 0; $i < 200; $i++) {
            $personne = new User();
            $personne
                ->setEmail($faker->email)
                ->setPassword($this->passwordEncoder->encodePassword($personne, 'password'))
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName)
                ->setAddress($faker->streetAddress)
                ->setCity('')
                ->setPhone($faker->isbn10)
                ->setLat(null)
                ->setLng(null)
                ->setCreated($faker->dateTimeThisDecade('now', 'Europe/Paris'))
                ->setUpdated($faker->dateTimeThisDecade('now', 'Europe/Paris'));

            $manager->persist($personne);

            // On envoie régulièrement en BDD pour ne pas saturer le cache
            if (($i % 20) === 0) {
                $manager->flush();
                $manager->clear(); // Detaches all objects from Doctrine!
            }
        }

        $manager->flush();
        $manager->clear();
    }

    public function getDependencies()
    {
        return array(
            CityFixtures::class,
        );
    }
}
