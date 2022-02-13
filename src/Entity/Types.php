<?php

namespace App\Entity;

use App\Repository\TypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypesRepository::class)
 */
class Types
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $famille;

    /**
     * @ORM\Column(type="boolean")
     */
    private $serialisable;

    /**
     * @ORM\Column(type="boolean")
     */
    private $option_type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Metiers::class, cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $metier_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFamille(): ?string
    {
        return $this->famille;
    }

    public function setFamille(string $famille): self
    {
        $this->famille = $famille;

        return $this;
    }

    public function getSerialisable(): ?bool
    {
        return $this->serialisable;
    }

    public function setSerialisable(bool $serialisable): self
    {
        $this->serialisable = $serialisable;

        return $this;
    }

    public function getOptionType(): ?bool
    {
        return $this->option_type;
    }

    public function setOptionType(bool $option_type): self
    {
        $this->option_type = $option_type;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMetierId(): ?Metiers
    {
        return $this->metier_id;
    }

    public function setMetierId(?Metiers $metier_id): self
    {
        $this->metier_id = $metier_id;

        return $this;
    }

    /**
     * Set id
     * @param integer $id
     * @return Types
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

}
