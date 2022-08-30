<?php

namespace App\Entity;

use App\Repository\DesignRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DesignRepository::class)]
#[Orm\Table(name: 'TripDesignes')]
class Design
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'DesignID', type: 'integer')]
    private $DesignID;

    #[ORM\Column(name: 'DesignName', type: 'string', length: 255)]
    private $DesignName;

    #[ORM\Column(name: 'DesignNameEN', type: 'string', length: 255)]
    private $DesignNameEN;

    #[ORM\Column(name: 'ImageLO', type: 'string', length: 255)]
    private $ImageLO;

    #[ORM\Column(type: 'boolean')]
    private $Visible;

    #[ORM\Column(name: 'CategoryID', type: 'integer')]
    private $CategoryID;

    #[ORM\Column(name: 'DBDate', type: 'datetime')]
    private $DBDate;

    #[ORM\Column(type: 'integer')]
    private $sort;

    #[ORM\Column(type: 'text')]
    private $Text;

    #[ORM\Column(type: 'boolean')]
    private $Search;

    #[ORM\OneToMany(mappedBy: 'design', targetEntity: Product::class)]
    private $products;

    #[ORM\ManyToOne(targetEntity: Label::class, inversedBy: 'designs')]
    #[ORM\JoinColumn(name: 'CategoryID', referencedColumnName: 'CategoryID', nullable: false)]
    private $label;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignID(): ?int
    {
        return $this->DesignID;
    }

    public function setDesignID(int $DesignID): self
    {
        $this->DesignID = $DesignID;

        return $this;
    }

    public function getDesignName(): ?string
    {
        return $this->DesignName;
    }

    public function setDesignName(string $DesignName): self
    {
        $this->DesignName = $DesignName;

        return $this;
    }

    public function getDesignNameEN(): ?string
    {
        return $this->DesignNameEN;
    }

    public function setDesignNameEN(string $DesignNameEN): self
    {
        $this->DesignNameEN = $DesignNameEN;

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

    public function isVisible(): ?bool
    {
        return $this->Visible;
    }

    public function setVisible(bool $Visible): self
    {
        $this->Visible = $Visible;

        return $this;
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

    public function getDBDate(): ?\DateTimeInterface
    {
        return $this->DBDate;
    }

    public function setDBDate(\DateTimeInterface $DBDate): self
    {
        $this->DBDate = $DBDate;

        return $this;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(int $sort): self
    {
        $this->sort = $sort;

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

    public function isSearch(): ?bool
    {
        return $this->Search;
    }

    public function setSearch(bool $Search): self
    {
        $this->Search = $Search;

        return $this;
    }

    public function getNameByLocale(string $locale): ?string
    {
        if ('ru' != $locale) {
            return $this->getDesignNameEN();
        } else {
            return $this->getDesignName();
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
            $product->setDesign($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getDesign() === $this) {
                $product->setDesign(null);
            }
        }

        return $this;
    }

    public function getLabel(): ?Label
    {
        return $this->label;
    }

    public function setLabel(?Label $label): self
    {
        $this->label = $label;

        return $this;
    }
}
