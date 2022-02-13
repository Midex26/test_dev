<?php

namespace App\Entity;

use App\Repository\MaterielsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterielsRepository::class)
 */
class Materiels
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
    private $reference_fabricant;

    /**
     * @ORM\Column(type="datetime")
     */
    private $debut_commmercialisation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fin_commercialisation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prix_public;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_court;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="text", length=65535, nullable=true)
     *
     */
    private $commentaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_administrable;

    /**
     * @ORM\ManyToOne(targetEntity=Types::class, cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_id;

    /**
     * @ORM\ManyToOne(targetEntity=Fabricants::class, inversedBy="materiels", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $fabricant_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferenceFabricant(): ?string
    {
        return $this->reference_fabricant;
    }

    public function setReferenceFabricant(string $reference_fabricant): self
    {
        $this->reference_fabricant = $reference_fabricant;

        return $this;
    }

    public function getDebutCommmercialisation(): ?\DateTimeInterface
    {
        return $this->debut_commmercialisation;
    }

    public function setDebutCommmercialisation(\DateTimeInterface $debut_commmercialisation): self
    {
        $this->debut_commmercialisation = $debut_commmercialisation;

        return $this;
    }

    public function getFinCommercialisation(): ?\DateTimeInterface
    {
        return $this->fin_commercialisation;
    }

    public function setFinCommercialisation(?\DateTimeInterface $fin_commercialisation): self
    {
        $this->fin_commercialisation = $fin_commercialisation;

        return $this;
    }

    public function getPrixPublic(): ?int
    {
        return $this->prix_public;
    }

    public function setPrixPublic(int $prix_public): self
    {
        $this->prix_public = $prix_public;

        return $this;
    }

    public function getNomCourt(): ?string
    {
        return $this->nom_court;
    }

    public function setNomCourt(string $nom_court): self
    {
        $this->nom_court = $nom_court;

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

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getIsAdministrable(): ?bool
    {
        return $this->is_administrable;
    }

    public function setIsAdministrable(bool $is_administrable): self
    {
        $this->is_administrable = $is_administrable;

        return $this;
    }

    public function getTypeId(): ?Types
    {
        return $this->type_id;
    }

    public function setTypeId(?Types $type_id): self
    {
        $this->type_id = $type_id;

        return $this;
    }

    public function getFabricantId(): ?Fabricants
    {
        return $this->fabricant_id;
    }

    public function setFabricantId(?Fabricants $fabricant_id): self
    {
        $this->fabricant_id = $fabricant_id;

        return $this;
    }
    /**
     * Set id
     * @param integer $id
     * @return Materiels
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

}
