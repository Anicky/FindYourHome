<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EstateAgencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=EstateAgencyRepository::class)
 */
class EstateAgency
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\ManyToMany(targetEntity=Estate::class, inversedBy="estateAgencies")
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
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
        }

        return $this;
    }

    public function removeEstate(Estate $estate): self
    {
        $this->estates->removeElement($estate);

        return $this;
    }
}
