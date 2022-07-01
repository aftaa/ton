<?php

namespace App\Entity;

use App\Repository\ColorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColorRepository::class)]
#[ORM\Table(name: 'TripColors')]
class Color
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ColorID', type: 'integer')]
    private $ColorID;

    #[ORM\Column(name: 'ColorName', type: 'string', length: 255)]
    private string $ColorName;

    #[ORM\Column(name: 'ColorNameEN', type: 'string', length: 255)]
    private string $ColorNameEN;

    public function getColorID(): ?int
    {
        return $this->ColorID;
    }

    public function setColorID(int $ColorID): self
    {
        $this->ColorID = $ColorID;

        return $this;
    }

    public function getColorName(): ?string
    {
        return $this->ColorName;
    }

    public function setName(string $Name): self
    {
        $this->ColorName = $Name;

        return $this;
    }

    public function getColorNameEN(): ?string
    {
        return $this->ColorNameEN;
    }

    public function setNameEN(string $NameEN): self
    {
        $this->ColorNameEN = $NameEN;

        return $this;
    }

    public function getNameByLocale(string $locale): string
    {
        if ('ru' != $locale) {
            return $this->getNameEN();
        } else {
            return $this->getName();
        }
    }
}
