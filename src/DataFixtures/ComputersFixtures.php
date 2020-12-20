<?php
namespace App\DataFixtures;

use App\Entity\Computers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class ComputersFixtures extends Fixture{
    public function load(ObjectManager $manager){
        

        for($i = 0; $i < 5; $i++){
            $computer = new Computers();
            $computer->setName("Ordi " . $i);
            $manager->persist($computer);
        }
        $manager->flush();
    }


}