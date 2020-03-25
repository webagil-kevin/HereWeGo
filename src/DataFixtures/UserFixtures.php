<?php

namespace App\DataFixtures;

use App\Entity\City;
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
        // On crée 1 admin
        $this->createUser($manager, 1, 'ROLE_ADMIN');

        // On crée 10 organisateurs
        $this->createUser($manager, 10, 'ROLE_ORG');

        // On crée 200 utilisateurs
        $this->createUser($manager, 200);
    }

    public function getDependencies()
    {
        return [
            CityFixtures::class,
        ];
    }

    private function createUser(ObjectManager $manager, $nbUsers, $roleUsers = null, $password = 'password')
    {
        $nbUsers = (int)$nbUsers > 0 ? (int)$nbUsers : 1;

        $faker = Faker\Factory::create('fr_FR');

        // on crée les utilisateurs
        for ($i = 0; $i < $nbUsers; $i++) {

            $roles = [];
            $city = $manager->getRepository(City::class)->find(random_int(1, 36500));

            if ($roleUsers === 'ROLE_ADMIN') {
                $email = 'admin' . ($i + 1) . '@herewego.test';
                $roles[] = 'ROLE_ADMIN';
            } elseif ($roleUsers === 'ROLE_ORG') {
                $email = 'org' . ($i + 1) . '@herewego.test';
                $roles[] = 'ROLE_ORG';
            } else {
                $email = 'user' . ($i + 1) . '@herewego.test';
            }

            $personne = new User();
            $personne
                ->setEmail($email)
                ->setPassword($this->passwordEncoder->encodePassword($personne, $password))
                ->setRoles($roles)
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName)
                ->setAddress($faker->streetAddress)
                ->setCity($city)
                ->setPhone('0' . random_int(100000001, 999999999))
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
}
