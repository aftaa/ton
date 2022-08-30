<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PageRepository::class)]
#[ORM\Table(name: 'TripPages')]
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'PageID', type: 'integer')]
    private $PageID;

    #[ORM\Column(type: 'string', length: 255)]
    private $Title;

    #[ORM\Column(name: 'TitleEN', type: 'string', length: 255)]
    private $TitleEN;

    #[ORM\Column(type: 'boolean')]
    private $Visible;

    #[ORM\Column(type: 'text')]
    private $Content;

    #[ORM\Column(name: 'ContentEN', type: 'text')]
    private $ContentEN;

    #[ORM\Column(type: 'string', length: 255)]
    private $seo_title;

    #[ORM\Column(type: 'string', length: 255)]
    private $seo_title_en;

    #[ORM\Column(type: 'text')]
    private $keywords;

    #[ORM\Column(type: 'text')]
    private $description;

    public function getPageID(): ?int
    {
        return $this->PageID;
    }

    public function setPageID(int $PageID): self
    {
        $this->PageID = $PageID;

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

    public function isVisible(): ?bool
    {
        return $this->Visible;
    }

    public function setVisible(bool $Visible): self
    {
        $this->Visible = $Visible;

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

    public function getSeoTitle(): ?string
    {
        return $this->seo_title;
    }

    public function setSeoTitle(string $seo_title): self
    {
        $this->seo_title = $seo_title;

        return $this;
    }

    public function getSeoTitleEn(): ?string
    {
        return $this->seo_title_en;
    }

    public function setSeoTitleEn(string $seo_title_en): self
    {
        $this->seo_title_en = $seo_title_en;

        return $this;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTitleByLocale(string $locale): string
    {
        if ('ru' != $locale) {
            return $this->getSeoTitleEn();
        } else {
            return $this->getSeoTitle();
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
