<?php

namespace App\Entity;

use App\Repository\ComputersRepository;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComputersRepository::class)
 */
class Computers
{

    public static $date;
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity=Assignements::class, mappedBy="computer", orphanRemoval=true) 
     */
    private $assign;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function AddAssign(Assignements $assign)
    {
        if(!$this->assign->contains($assign)){
            $this->assign[] = $assign;
            $assign->setComputer($this);
        }

        return $this;
    }

    public function getAssignements(): Collection
    {
        $date = self::$date;
        return $this->assign->filter(function($attr) use ($date){
            $date =  new DateTime($date);
            return $attr->getDate() == $date;
        });
    }

    public function delAssign(Assignements $assign){
        if($this->assign->removeElement($assign)){
            if($assign->getComputer() === $this){
                // $assign->setComputer(NULL);
            }
        }
    }
}
