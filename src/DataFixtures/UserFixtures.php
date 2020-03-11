<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\DataFixtures\CityFixtures;
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

        // On créé un admin
        $personne = new User();
        $personne->setEmail('admin@admin.fr');
        $personne->setPassword($this->passwordEncoder->encodePassword(
            $personne,
            'password'
        ));
        $personne->setRoles(['ROLE_ADMIN']);
        $personne->setFirstname($faker->firstName());
        $personne->setLastname($faker->lastName);
        $personne->setAddress($faker->streetAddress);
        $personne->setCity('');
        $personne->setPhone($faker->isbn10);
        $personne->setLat(null);
        $personne->setLng(null);
        $personne->setCreated($faker->dateTimeThisDecade('now', 'Europe/Paris'));
        $personne->setUpdated($faker->dateTimeThisDecade('now', 'Europe/Paris'));

        $manager->persist($personne);

        // On créé 10 utilisateurs
        for ($i = 0; $i < 10; $i++) {
            $personne = new User();
            $personne->setEmail($faker->email);
            $personne->setPassword($this->passwordEncoder->encodePassword(
                $personne,
                'password'
            ));
            $personne->setFirstname($faker->firstName());
            $personne->setLastname($faker->lastName);
            $personne->setAddress($faker->streetAddress);
            $personne->setCity('');
            $personne->setPhone($faker->isbn10);
            $personne->setLat(null);
            $personne->setLng(null);
            $personne->setCreated($faker->dateTimeThisDecade('now', 'Europe/Paris'));
            $personne->setUpdated($faker->dateTimeThisDecade('now', 'Europe/Paris'));

            $manager->persist($personne);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CityFixtures::class,
        );
    }
}
