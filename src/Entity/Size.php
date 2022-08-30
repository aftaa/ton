<?php

namespace App\Entity;

use App\Repository\SizeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SizeRepository::class)]
#[ORM\Table(name: 'TripSizes')]
class Size implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'SizeID', type: 'integer')]
    private $SizeID;

    #[ORM\Column(name: 'SizeName', type: 'string', length: 255)]
    private $SizeName;

    public function getSizeID(): ?int
    {
        return $this->SizeID;
    }

    public function setSizeID(int $SizeID): self
    {
        $this->SizeID = $SizeID;

        return $this;
    }

    public function getSizeName(): ?string
    {
        return $this->SizeName;
    }

    public function setSizeName(string $SizeName): self
    {
        $this->SizeName = $SizeName;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getSizeName();
    }
}
