<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsRepository::class)]
#[ORM\Table(name: 'TripNews')]
class News
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'NewsID', type: 'integer')]
    private $NewsID;

    #[ORM\Column(type: 'string', length: 255)]
    private $Title;

    #[ORM\Column(name: 'TitleEN', type: 'string', length: 255)]
    private $TitleEN;

    #[ORM\Column(type: 'boolean')]
    private $display_ru;

    #[ORM\Column(type: 'boolean')]
    private $display_en;

    #[ORM\Column(name: 'NewsDate', type: 'date')]
    private $NewsDate;

    #[ORM\Column(name: 'ImageLO', type: 'string', length: 255)]
    private $ImageLO;

    #[ORM\Column(name: 'ImageHI', type: 'string', length: 255)]
    private $ImageHI;

    #[ORM\Column(type: 'text')]
    private $Content;

    #[ORM\Column(name: 'ContentEN', type: 'string', length: 255)]
    private $ContentEN;

    #[ORM\Column(type: 'string', length: 255)]
    private $Link;

    #[ORM\Column(name: 'SizeX', type: 'integer')]
    private $SizeX;

    #[ORM\Column(name: 'SizeY', type: 'integer')]
    private $SizeY;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNewsID(): ?int
    {
        return $this->NewsID;
    }

    public function setNewsID(int $NewsID): self
    {
        $this->NewsID = $NewsID;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getTitleEN(): ?string
    {
        return $this->TitleEN;
    }

    public function setTitleEN(string $TitleEN): self
    {
        $this->TitleEN = $TitleEN;

        return $this;
    }

    public function isDisplayRu(): ?bool
    {
        return $this->display_ru;
    }

    public function setDisplayRu(bool $display_ru): self
    {
        $this->display_ru = $display_ru;

        return $this;
    }

    public function isDisplayEn(): ?bool
    {
        return $this->display_en;
    }

    public function setDisplayEn(bool $display_en): self
    {
        $this->display_en = $display_en;

        return $this;
    }

    public function getNewsDate(): ?\DateTimeInterface
    {
        return $this->NewsDate;
    }

    public function setNewsDate(\DateTimeInterface $NewsDate): self
    {
        $this->NewsDate = $NewsDate;

        return $this;
    }

    public function getImageLO(): ?string
    {
        return $this->ImageLO;
    }

    public function setImageLO(string $ImageLO): self
    {
        $this->ImageLO = $ImageLO;

        return $this;
    }

    public function getImageHI(): ?string
    {
        return $this->ImageHI;
    }

    public function setImageHI(string $ImageHI): self
    {
        $this->ImageHI = $ImageHI;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function getContentEN(): ?string
    {
        return $this->ContentEN;
    }

    public function setContentEN(string $ContentEN): self
    {
        $this->ContentEN = $ContentEN;

        return $this;
    }

    public function getLink(): ?string
    {
        $link = str_replace('http://www.trip-o-nation.com/', '/', $this->Link);
        $link = str_replace('http://trip-o-nation.com/', '/', $link);
        return $link;
    }

    public function setLink(string $Link): self
    {
        $this->Link = $Link;

        return $this;
    }

    public function getSizeX(): ?int
    {
        return $this->SizeX;
    }

    public function setSizeX(int $SizeX): self
    {
        $this->SizeX = $SizeX;

        return $this;
    }

    public function getSizeY(): ?int
    {
        return $this->SizeY;
    }

    public function setSizeY(int $SizeY): self
    {
        $this->SizeY = $SizeY;

        return $this;
    }

    public function getTitleByLocale(string $locale): string
    {
        if ('ru' != $locale) {
            return $this->getTitleEN();
        } else {
            return $this->getTitle();
        }
    }

    public function getContentByLocale(string $locale): string
    {
        if ('ru' != $locale) {
            return $this->getContentEN();
        } else {
            return $this->getContent();
        }
    }
}
