<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeaveCategoryRepository")
 */
class LeaveCategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $limitDays;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Leave", mappedBy="category", orphanRemoval=true)
     */
    private $leaves;

    public function __construct()
    {
        $this->leaves = new ArrayCollection();
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

    public function getLimitDays(): ?int
    {
        return $this->limitDays;
    }

    public function setLimitDays(?int $limitDays): self
    {
        $this->limitDays = $limitDays;

        return $this;
    }

    /**
     * @return Collection|Leave[]
     */
    public function getLeaves(): Collection
    {
        return $this->leaves;
    }

    public function addLeaf(Leave $leaf): self
    {
        if (!$this->leaves->contains($leaf)) {
            $this->leaves[] = $leaf;
            $leaf->setCategory($this);
        }

        return $this;
    }

    public function removeLeaf(Leave $leaf): self
    {
        if ($this->leaves->contains($leaf)) {
            $this->leaves->removeElement($leaf);
            // set the owning side to null (unless already changed)
            if ($leaf->getCategory() === $this) {
                $leaf->setCategory(null);
            }
        }

        return $this;
    }
}
