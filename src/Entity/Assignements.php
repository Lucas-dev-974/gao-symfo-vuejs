<?php

namespace App\Entity;

use App\Repository\AssignementsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AssignementsRepository::class)
 */
class Assignements
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    
    /**
     * @ORM\ManyToOne(targetEntity=Computers::class, inversedBy="attributions")
     */
    private $computer;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class, inversedBy="attributions")
     */
    private $clients;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $horraire;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Clients
    {
        return $this->clients;
    }

    public function setClient(Clients $clients): self
    {
        $this->clients = $clients;

        return $this;
    }

    public function getComputer(): ?Computers
    {
        return $this->computer;
    }

    public function setComputer(Computers $computer): self
    {
        $this->computer = $computer;

        return $this;
    }

    public function getHorraire(): ?string
    {
        return $this->horraire;
    }

    public function setHorraire(string $horraire): self
    {
        $this->horraire = $horraire;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
