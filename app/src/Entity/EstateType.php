<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EstateTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=EstateTypeRepository::class)
 */
class EstateType
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
     * @ORM\OneToMany(targetEntity=Estate::class, mappedBy="estateType")
     */
    private $estates;

    public function __construct()
    {
        $this->estates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return Collection|Estate[]
     */
    public function getEstates(): Collection
    {
        return $this->estates;
    }

    public function addEstate(Estate $estate): self
    {
        if (!$this->estates->contains($estate)) {
            $this->estates[] = $estate;
            $estate->setEstateType($this);
        }

        return $this;
    }

    public function removeEstate(Estate $estate): self
    {
        if ($this->estates->removeElement($estate)) {
            // set the owning side to null (unless already changed)
            if ($estate->getEstateType() === $this) {
                $estate->setEstateType(null);
            }
        }

        return $this;
    }

}
