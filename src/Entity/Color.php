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

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\Column(name: 'NameEN', type: 'string', length: 255)]
    private $NameEN;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColorID(): ?int
    {
        return $this->ColorID;
    }

    public function setColorID(int $ColorID): self
    {
        $this->ColorID = $ColorID;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getNameEN(): ?string
    {
        return $this->NameEN;
    }

    public function setNameEN(string $NameEN): self
    {
        $this->NameEN = $NameEN;

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
