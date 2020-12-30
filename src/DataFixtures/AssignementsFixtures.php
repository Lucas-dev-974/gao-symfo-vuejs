<?php

namespace App\DataFixtures;

use App\Entity\Assignements;
use App\Entity\Clients;
use App\Repository\ClientsRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AssignementsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        // $assign = new Assignements();
        // $assign->setClient(ClientsRepository->find(6));   
        // $assign->setComputer(1);
        // $assign->setDate(new DateTime('2020-12-24'));
        // $assign->setHorraire('21');
        // $manager->persist($assign);
        $manager->flush();
    }
}
