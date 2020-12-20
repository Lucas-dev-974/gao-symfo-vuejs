<?php
namespace App\DataFixtures;

use App\Entity\Clients;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class ClientsFixtures extends Fixture{
    public function load(ObjectManager $manager){
        
        $faker = Faker\Factory::create('fr_FR');

        for($i = 0; $i < 5; $i++){
            $allname = explode(' ', $faker->name());
            $client = new Clients();
            $client->setName($allname[0]);
            $client->setLastName($allname[1]);
            $manager->persist($client);
        }
        $manager->flush();
    }


}