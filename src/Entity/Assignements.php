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
     * @ORM\Column(type="integer")
     */
    private $id_client;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_computer;

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

    public function getIdClient(): ?int
    {
        return $this->id_client;
    }

    public function setIdClient(int $id_client): self
    {
        $this->id_client = $id_client;

        return $this;
    }

    public function getIdComputer(): ?int
    {
        return $this->id_computer;
    }

    public function setIdComputer(int $id_computer): self
    {
        $this->id_computer = $id_computer;

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
