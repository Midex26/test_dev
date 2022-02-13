<?php

namespace App\Entity;

use App\Repository\MetiersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MetiersRepository::class)
 */
class Metiers
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
     * @ORM\ManyToMany(targetEntity=Fabricants::class, mappedBy="metier_fabricants")
     */
    private $fabricants;

    public function __construct()
    {
        $this->fabricants = new ArrayCollection();
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
     * @return Collection|Fabricants[]
     */
    public function getFabricants(): Collection
    {
        return $this->fabricants;
    }

    public function addFabricant(Fabricants $fabricant): self
    {
        if (!$this->fabricants->contains($fabricant)) {
            $this->fabricants[] = $fabricant;
            $fabricant->addMetierFabricant($this);
        }

        return $this;
    }

    public function removeFabricant(Fabricants $fabricant): self
    {
        if ($this->fabricants->removeElement($fabricant)) {
            $fabricant->removeMetierFabricant($this);
        }

        return $this;
    }

    /**
     * Set id
     * @param integer $id
     * @return Metiers
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }
}
