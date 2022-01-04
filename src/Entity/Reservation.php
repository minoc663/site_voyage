<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $tarif_total;

    /**
     * @ORM\ManyToOne(targetEntity=Vol::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vol;

    /**
     * @ORM\ManyToOne(targetEntity=Hebergement::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hebergement;

    /**
     * @ORM\ManyToOne(targetEntity=Voyageur::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voyageur;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTarifTotal(): ?float
    {
        return $this->tarif_total;
    }

    public function setTarifTotal(float $tarif_total): self
    {
        $this->tarif_total = $tarif_total;

        return $this;
    }

    public function getVol(): ?Vol
    {
        return $this->vol;
    }

    public function setVol(?Vol $vol): self
    {
        $this->vol = $vol;

        return $this;
    }

    public function getHebergement(): ?Hebergement
    {
        return $this->hebergement;
    }

    public function setHebergement(?Hebergement $hebergement): self
    {
        $this->hebergement = $hebergement;

        return $this;
    }

    public function getVoyageur(): ?Voyageur
    {
        return $this->voyageur;
    }

    public function setVoyageur(?Voyageur $voyageur): self
    {
        $this->voyageur = $voyageur;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
