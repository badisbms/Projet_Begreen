<?php

namespace App\Entity;

use App\Repository\PlantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlantRepository::class)
 */
class Plant
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
    private $frenchName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $latinName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $family;

    /**
     * @ORM\Column(type="text")
     */
    private $origin;

    /**
     * @ORM\Column(type="text")
     */
    private $flowering;

    /**
     * @ORM\Column(type="text")
     */
    private $planting;

    /**
     * @ORM\Column(type="text")
     */
    private $maintenance;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isInEncyclopedia;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="fk_Plant")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="plant", orphanRemoval=true)
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrenchName(): ?string
    {
        return $this->frenchName;
    }

    public function setFrenchName(string $frenchName): self
    {
        $this->frenchName = $frenchName;

        return $this;
    }

    public function getLatinName(): ?string
    {
        return $this->latinName;
    }

    public function setLatinName(string $latinName): self
    {
        $this->latinName = $latinName;

        return $this;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(string $family): self
    {
        $this->family = $family;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getFlowering(): ?string
    {
        return $this->flowering;
    }

    public function setFlowering(string $flowering): self
    {
        $this->flowering = $flowering;

        return $this;
    }

    public function getPlanting(): ?string
    {
        return $this->planting;
    }

    public function setPlanting(string $planting): self
    {
        $this->planting = $planting;

        return $this;
    }

    public function getMaintenance(): ?string
    {
        return $this->maintenance;
    }

    public function setMaintenance(string $maintenance): self
    {
        $this->maintenance = $maintenance;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getIsInEncyclopedia(): ?bool
    {
        return $this->isInEncyclopedia;
    }

    public function setIsInEncyclopedia(bool $isInEncyclopedia): self
    {
        $this->isInEncyclopedia = $isInEncyclopedia;

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

    /**
     * @return Collection|Images[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setPlant($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getPlant() === $this) {
                $image->setPlant(null);
            }
        }

        return $this;
    }
}
