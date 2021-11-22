<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromotionRepository::class)
 */
class Promotion
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="promotion")
     */
    private $fk_User;

    public function __construct()
    {
        $this->fk_User = new ArrayCollection();
    }

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

    /**
     * @return Collection|User[]
     */
    public function getFkUser(): Collection
    {
        return $this->fk_User;
    }

    public function addFkUser(User $fkUser): self
    {
        if (!$this->fk_User->contains($fkUser)) {
            $this->fk_User[] = $fkUser;
            $fkUser->setPromotion($this);
        }

        return $this;
    }

    public function removeFkUser(User $fkUser): self
    {
        if ($this->fk_User->removeElement($fkUser)) {
            // set the owning side to null (unless already changed)
            if ($fkUser->getPromotion() === $this) {
                $fkUser->setPromotion(null);
            }
        }

        return $this;
    }
}
