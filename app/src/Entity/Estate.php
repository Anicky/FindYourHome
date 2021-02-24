<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EstateRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=EstateRepository::class)
 */
class Estate
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
    private string $title;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Type("\DateTimeInterface")
     */
    private DateTime $publicationDate;

    /**
     * @ORM\Column(type="integer")
     */
    private int $price;

    /**
     * @ORM\Column(type="integer")
     */
    private int $surfaceArea;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $location;

    /**
     * @ORM\Column(type="integer")
     */
    private int $numberOfPieces;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private string $description;

    /**
     * @ORM\ManyToOne(targetEntity=EstateType::class, inversedBy="estates")
     * @ORM\JoinColumn(nullable=false)
     */
    private $estateType;

    /**
     * @ORM\ManyToMany(targetEntity=EstateAgency::class, mappedBy="estates")
     */
    private $estateAgencies;

    public function __construct()
    {
        $this->estateAgencies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return DateTime
     */
    public function getPublicationDate(): DateTime
    {
        return $this->publicationDate;
    }

    /**
     * @param DateTime $publicationDate
     */
    public function setPublicationDate(DateTime $publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getSurfaceArea(): int
    {
        return $this->surfaceArea;
    }

    /**
     * @param int $surfaceArea
     */
    public function setSurfaceArea(int $surfaceArea): void
    {
        $this->surfaceArea = $surfaceArea;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    /**
     * @return int
     */
    public function getNumberOfPieces(): int
    {
        return $this->numberOfPieces;
    }

    /**
     * @param int $numberOfPieces
     */
    public function setNumberOfPieces(int $numberOfPieces): void
    {
        $this->numberOfPieces = $numberOfPieces;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getEstateType(): ?EstateType
    {
        return $this->estateType;
    }

    public function setEstateType(?EstateType $estateType): self
    {
        $this->estateType = $estateType;

        return $this;
    }

    /**
     * @return Collection|EstateAgency[]
     */
    public function getEstateAgencies(): Collection
    {
        return $this->estateAgencies;
    }

    public function addEstateAgency(EstateAgency $estateAgency): self
    {
        if (!$this->estateAgencies->contains($estateAgency)) {
            $this->estateAgencies[] = $estateAgency;
            $estateAgency->addEstate($this);
        }

        return $this;
    }

    public function removeEstateAgency(EstateAgency $estateAgency): self
    {
        if ($this->estateAgencies->removeElement($estateAgency)) {
            $estateAgency->removeEstate($this);
        }

        return $this;
    }

}
