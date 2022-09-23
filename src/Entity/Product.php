<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table(name: 'TripProducts')]
class Product implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ProductID', type: 'integer')]
    private int $ProductID;

    #[ORM\Column(name: 'CategoryID', type: 'integer')]
    private int $CategoryID;

    #[ORM\Column(name: 'DBDate', type: 'datetime')]
    private \DateTimeInterface $DBDate;

    #[ORM\Column(type: 'string', length: 255)]
    private string $Name;

    #[ORM\Column(name: 'NameEN', type: 'string', length: 255)]
    private string $NameEN;

    #[ORM\Column(type: 'boolean')]
    private bool $display_ru;

    #[ORM\Column(type: 'boolean')]
    private bool $display_en;

    #[ORM\Column(type: 'boolean')]
    private bool $Visible;

    #[ORM\Column(type: 'boolean')]
    private bool $Marked;

    #[ORM\Column(name: 'MarkedTime', type: 'datetime')]
    private \DateTimeInterface $MarkedTime;

    #[ORM\Column(type: 'text')]
    private string $Description;

    #[ORM\Column(name: 'DescriptionEN', type: 'text')]
    private string $DescriptionEN;

    #[ORM\Column(name: 'ImageLO', type: 'string', length: 255)]
    private string $ImageLO;

    #[ORM\Column(name: 'ImageHI', type: 'string', length: 255)]
    private string $ImageHI;

    #[ORM\Column(name: 'ImageFL', type: 'string', length: 255)]
    private string $ImageFL;

    #[ORM\Column(name: 'ImageHB', type: 'string', length: 255)]
    private string $ImageHB;

    #[ORM\Column(name: 'ImageFB', type: 'string', length: 255)]
    private string $ImageFB;

    #[ORM\Column(type: 'integer')]
    private int $Price;

    #[ORM\Column(name: 'PriceEN', type: 'integer')]
    private int $PriceEN;

    #[ORM\Column(type: 'string', length: 255)]
    private string $Articul;

    #[ORM\Column(name: 'TypeID', type: 'integer')]
    private int $TypeID;

    #[ORM\Column(name: 'DesignID', type: 'integer')]
    private int $DesignID;

    #[ORM\Column(type: 'string', length: 1)]
    private string $Sale;

    #[ORM\Column(type: 'boolean')]
    private bool $Search;

    #[ORM\Column(type: 'text')]
    private ?string $keywords;

    #[ORM\Column(type: 'text')]
    private ?string $meta_description;

    #[ORM\ManyToOne(targetEntity: Type::class, inversedBy: 'products')]
    #[ORM\JoinColumn(name: 'TypeID', referencedColumnName: 'TypeID', nullable: false)]
    private ?Type $type;

    #[ORM\ManyToOne(targetEntity: Design::class, inversedBy: 'products')]
    #[ORM\JoinColumn(name: 'DesignID', referencedColumnName: 'DesignID', nullable: false)]
    private ?Design $design;

    #[ORM\ManyToOne(targetEntity: Label::class, inversedBy: 'products')]
    #[ORM\JoinColumn(name: 'CategoryID', referencedColumnName: 'CategoryID', nullable: false)]
    private ?Label $label;

    #[ORM\OneToMany(mappedBy: 'relation', targetEntity: Like::class)]
    private Collection $likes;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->likes = new ArrayCollection();
    }

    public function getProductID(): ?int
    {
        return $this->ProductID;
    }

    public function setProductID(int $ProductID): self
    {
        $this->ProductID = $ProductID;

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

    public function isVisible(): ?bool
    {
        return $this->Visible;
    }

    public function setVisible(bool $Visible): self
    {
        $this->Visible = $Visible;

        return $this;
    }

    public function isMarked(): ?bool
    {
        return $this->Marked;
    }

    public function setMarked(bool $Marked): self
    {
        $this->Marked = $Marked;

        return $this;
    }

    public function getMarkedTime(): ?\DateTimeInterface
    {
        return $this->MarkedTime;
    }

    public function setMarkedTime(\DateTimeInterface $MarkedTime): self
    {
        $this->MarkedTime = $MarkedTime;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDescriptionEN(): ?string
    {
        return $this->DescriptionEN;
    }

    public function setDescriptionEN(string $DescriptionEN): self
    {
        $this->DescriptionEN = $DescriptionEN;

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

    public function getImageFL(): ?string
    {
        return $this->ImageFL;
    }

    public function setImageFL(string $ImageFL): self
    {
        $this->ImageFL = $ImageFL;

        return $this;
    }

    public function getImageHB(): ?string
    {
        return $this->ImageHB;
    }

    public function setImageHB(string $ImageHB): self
    {
        $this->ImageHB = $ImageHB;

        return $this;
    }

    public function getImageFB(): ?string
    {
        return $this->ImageFB;
    }

    public function setImageFB(string $ImageFB): self
    {
        $this->ImageFB = $ImageFB;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->Price;
    }

    public function setPrice(int $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getPriceEN(): ?int
    {
        return $this->PriceEN;
    }

    public function setPriceEN(int $PriceEN): self
    {
        $this->PriceEN = $PriceEN;

        return $this;
    }

    public function getArticul(): ?string
    {
        return $this->Articul;
    }

    public function setArticul(string $Articul): self
    {
        $this->Articul = $Articul;

        return $this;
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

    public function getDesignID(): ?int
    {
        return $this->DesignID;
    }

    public function setDesignID(int $DesignID): self
    {
        $this->DesignID = $DesignID;

        return $this;
    }

    public function getSale(): ?string
    {
        return $this->Sale;
    }

    public function setSale(string $Sale): self
    {
        $this->Sale = $Sale;

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

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->meta_description;
    }

    public function setMetaDescription(string $meta_description): self
    {
        $this->meta_description = $meta_description;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

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

    public function getDescriptionByLocale(string $locale): string
    {
        if ('ru' != $locale) {
            return $this->getDescriptionEN();
        } else {
            return $this->getDescription();
        }
    }

    public function getDesign(): ?Design
    {
        return $this->design;
    }

    public function setDesign(?Design $design): self
    {
        $this->design = $design;

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

    public function __toString(): string
    {
        return $this->getProductID();
    }

    /**
     * @return Collection<int, Like>
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Like $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes->add($like);
            $like->setRelation($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getRelation() === $this) {
                $like->setRelation(null);
            }
        }

        return $this;
    }
}
