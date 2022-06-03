<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
#[ORM\Table(name: 'TripTypes')]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'TypeID', type: 'integer')]
    private ?int $TypeID;

    #[ORM\Column(name: 'TypeName', type: 'string', length: 255)]
    private ?string $TypeName;

    #[ORM\Column(name: 'TypeNameEN', type: 'string', length: 255)]
    private ?string $TypeNameEN;

    #[ORM\Column(type: 'boolean')]
    private ?bool $Visible;

    #[ORM\Column(name: 'MenuOrder', type: 'integer')]
    private ?int $MenuOrder;

    #[ORM\Column(type: 'text')]
    private ?string $Text;

    #[ORM\Column(name: 'SexID', type: 'smallint')]
    private ?int $SexID;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $seo_title;

    #[ORM\Column(type: 'text')]
    private ?string $Text2;

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $seo_uri;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Product::class)]
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getTypeID(): ?int
    {
        return $this->TypeID;
    }

    public function setTypeID(int $TypeID): self
    {
        $this->TypeID = $TypeID;

        return $this;
    }

    public function getTypeName(): ?string
    {
        return $this->TypeName;
    }

    public function setTypeName(string $TypeName): self
    {
        $this->TypeName = $TypeName;

        return $this;
    }

    public function getTypeNameEN(): ?string
    {
        return $this->TypeNameEN;
    }

    public function setTypeNameEN(string $TypeNameEN): self
    {
        $this->TypeNameEN = $TypeNameEN;

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

    public function getMenuOrder(): ?int
    {
        return $this->MenuOrder;
    }

    public function setMenuOrder(int $MenuOrder): self
    {
        $this->MenuOrder = $MenuOrder;

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

    public function getSexID(): ?int
    {
        return $this->SexID;
    }

    public function setSexID(int $SexID): self
    {
        $this->SexID = $SexID;

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

    public function getText2(): ?string
    {
        return $this->Text2;
    }

    public function setText2(string $Text2): self
    {
        $this->Text2 = $Text2;

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

    public function getNameByLocale(string $locale): string
    {
        if ('ru' != $locale) {
            return $this->getTypeNameEN();
        } else {
            return $this->getTypeName();
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
            $product->setType($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getType() === $this) {
                $product->setType(null);
            }
        }

        return $this;
    }
}
