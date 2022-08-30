<?php

namespace App\Entity;

use App\Repository\LabelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LabelRepository::class)]
#[ORM\Table(name: 'TripCategories')]
class Label
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'CategoryID', type: 'integer')]
    private $CategoryID;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\Column(name: 'NameEN', type: 'string', length: 255)]
    private $NameEN;

    #[ORM\Column(type: 'boolean')]
    private $Visible;

    #[ORM\Column(type: 'string', length: 255)]
    private $Image;

    #[ORM\Column(name: 'MenuOrder', type: 'integer')]
    private $MenuOrder;

    #[ORM\Column(name: 'ImageTitle', type: 'string', length: 255)]
    private $ImageTitle;

    #[ORM\Column(name: 'ShowBy', type: 'smallint')]
    private $ShowBy;

    #[ORM\Column(type: 'text')]
    private $Text;

    #[ORM\Column(name: 'PageTitle', type: 'text')]
    private $PageTitle;

    #[ORM\Column(type: 'string', length: 50)]
    private $seo_uri;

    #[ORM\Column(type: 'text')]
    private $keywords;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\OneToMany(mappedBy: 'label', targetEntity: Product::class)]
    private $products;

    #[ORM\OneToMany(mappedBy: 'label', targetEntity: Design::class)]
    private $designs;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->designs = new ArrayCollection();
    }

    public function getCategoryID(): ?int
    {
        return $this->CategoryID;
    }

    public function setCategoryID(int $CategoryID): self
    {
        $this->CategoryID = $CategoryID;

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

    public function isVisible(): ?bool
    {
        return $this->Visible;
    }

    public function setVisible(bool $Visible): self
    {
        $this->Visible = $Visible;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getMenuOrder(): ?int
    {
        return $this->MenuOrder;
    }

    public function setMenuOrder(int $MenuOrder): self
    {
        $this->MenuOrder = $MenuOrder;

        return $this;
    }

    public function getImageTitle(): ?string
    {
        return $this->ImageTitle;
    }

    public function setImageTitle(string $ImageTitle): self
    {
        $this->ImageTitle = $ImageTitle;

        return $this;
    }

    public function getShowBy(): ?int
    {
        return $this->ShowBy;
    }

    public function setShowBy(int $ShowBy): self
    {
        $this->ShowBy = $ShowBy;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->Text;
    }

    public function setText(string $Text): self
    {
        $this->Text = $Text;

        return $this;
    }

    public function getPageTitle(): ?string
    {
        return $this->PageTitle;
    }

    public function setPageTitle(string $PageTitle): self
    {
        $this->PageTitle = $PageTitle;

        return $this;
    }

    public function getSeoUri(): ?string
    {
        return $this->seo_uri;
    }

    public function setSeoUri(string $seo_uri): self
    {
        $this->seo_uri = $seo_uri;

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

    public function getNameByLocale(string $locale): string
    {
        if ('ru' != $locale) {
            return $this->getNameEN();
        } else {
            return $this->getName();
        }
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setLabel($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getLabel() === $this) {
                $product->setLabel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Design>
     */
    public function getDesigns(): Collection
    {
        return $this->designs;
    }

    public function addDesign(Design $design): self
    {
        if (!$this->designs->contains($design)) {
            $this->designs[] = $design;
            $design->setLabel($this);
        }

        return $this;
    }

    public function removeDesign(Design $design): self
    {
        if ($this->designs->removeElement($design)) {
            // set the owning side to null (unless already changed)
            if ($design->getLabel() === $this) {
                $design->setLabel(null);
            }
        }

        return $this;
    }
}
