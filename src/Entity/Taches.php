<?php

namespace App\Entity;

use App\Repository\TachesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TachesRepository::class)
 */
class Taches
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomTache;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $avancementTache;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionTache;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $limiteDateTache;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $attributionTache;

    /**
     * @ORM\Column(type="integer")
     */
    private $idTabs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTache(): ?string
    {
        return $this->nomTache;
    }

    public function setNomTache(string $nomTache): self
    {
        $this->nomTache = $nomTache;

        return $this;
    }

    public function getAvancementTache(): ?string
    {
        return $this->avancementTache;
    }

    public function setAvancementTache(string $avancementTache): self
    {
        $this->avancementTache = $avancementTache;

        return $this;
    }

    public function getDescriptionTache(): ?string
    {
        return $this->descriptionTache;
    }

    public function setDescriptionTache(string $descriptionTache): self
    {
        $this->descriptionTache = $descriptionTache;

        return $this;
    }

    public function getLimiteDateTache(): ?\DateTimeInterface
    {
        return $this->limiteDateTache;
    }

    public function setLimiteDateTache(?\DateTimeInterface $limiteDateTache): self
    {
        $this->limiteDateTache = $limiteDateTache;

        return $this;
    }

    public function getAttributionTache(): ?string
    {
        return $this->attributionTache;
    }

    public function setAttributionTache(?string $attributionTache): self
    {
        $this->attributionTache = $attributionTache;

        return $this;
    }

    public function getIdTabs(): ?int
    {
        return $this->idTabs;
    }

    public function setIdTabs(int $idTabs): self
    {
        $this->idTabs = $idTabs;

        return $this;
    }
}
