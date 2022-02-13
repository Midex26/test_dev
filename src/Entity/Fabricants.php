<?php

namespace App\Entity;

use App\Repository\FabricantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FabricantsRepository::class)
 */
class Fabricants
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
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Materiels::class, mappedBy="fabricant_id")
     */
    private $materiels;

    /**
     * @ORM\ManyToMany(targetEntity=Metiers::class, inversedBy="fabricants")
     */
    private $metier_fabricants;

    public function __construct()
    {
        $this->materiels = new ArrayCollection();
        $this->metier_fabricants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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

    /**
     * @return Collection|Materiels[]
     */
    public function getMateriels(): Collection
    {
        return $this->materiels;
    }

    public function addMateriel(Materiels $materiel): self
    {
        if (!$this->materiels->contains($materiel)) {
            $this->materiels[] = $materiel;
            $materiel->setFabricantId($this);
        }

        return $this;
    }

    public function removeMateriel(Materiels $materiel): self
    {
        if ($this->materiels->removeElement($materiel)) {
            // set the owning side to null (unless already changed)
            if ($materiel->getFabricantId() === $this) {
                $materiel->setFabricantId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Metiers[]
     */
    public function getMetierFabricants(): Collection
    {
        return $this->metier_fabricants;
    }

    public function addMetierFabricant(Metiers $metierFabricant): self
    {
        if (!$this->metier_fabricants->contains($metierFabricant)) {
            $this->metier_fabricants[] = $metierFabricant;
        }

        return $this;
    }

    public function removeMetierFabricant(Metiers $metierFabricant): self
    {
        $this->metier_fabricants->removeElement($metierFabricant);

        return $this;
    }

    /**
     * Set id
     * @param integer $id
     * @return Fabricants
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
