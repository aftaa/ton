<?php

namespace App\Entity;

use App\Repository\OrderDetailRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrderDetailRepository::class)]
#[ORM\Table(name: 'TripOrderDetails')]
class OrderDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'OrderDetailsID', type: 'integer')]
    private $OrderDetailsID;

    #[ORM\Column(name: 'OrderID', type: 'integer')]
    private $OrderID;

    #[ORM\Column(name: 'ProductID', type: 'integer')]
    private $ProductID;

    #[ORM\Column(name: 'SizeID', type: 'integer')]
    private $SizeID;

    #[ORM\Column(name: 'ProductDesc', type: 'string', length: 255)]
    private $ProductDesc;

    #[ORM\Column(name: 'ProductPrice', type: 'integer')]
    private $ProductPrice;

    #[ORM\Column(name: 'ProductSize', type: 'integer', nullable: true)]
    private $ProductSize;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank]
    #[Assert\GreaterThanOrEqual(1)]
    private $Quantity;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'details')]
    #[ORM\JoinColumn(name: 'OrderID', referencedColumnName: 'OrderID', nullable: false)]
    private $cart;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(name: 'ProductID', referencedColumnName: 'ProductID', nullable: false)]
    private $product;

    #[ORM\ManyToOne(targetEntity: Size::class)]
    #[ORM\JoinColumn(name: 'SizeID', referencedColumnName: 'SizeID', nullable: false)]
    private $size;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDetailsID(): ?int
    {
        return $this->OrderDetailsID;
    }

    public function setOrderDetailsID(int $OrderDetailsID): self
    {
        $this->OrderDetailsID = $OrderDetailsID;

        return $this;
    }

    public function getOrderID(): ?int
    {
        return $this->OrderID;
    }

    public function setOrderID(int $OrderID): self
    {
        $this->OrderID = $OrderID;

        return $this;
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

    public function getSizeID(): ?int
    {
        return $this->SizeID;
    }

    public function setSizeID(int $SizeID): self
    {
        $this->SizeID = $SizeID;

        return $this;
    }

    public function getProductDesc(): ?string
    {
        return $this->ProductDesc;
    }

    public function setProductDesc(string $ProductDesc): self
    {
        $this->ProductDesc = $ProductDesc;

        return $this;
    }

    public function getProductPrice(): ?int
    {
        return $this->ProductPrice;
    }

    public function setProductPrice(int $ProductPrice): self
    {
        $this->ProductPrice = $ProductPrice;

        return $this;
    }

    public function getProductSize(): ?int
    {
        return $this->ProductSize;
    }

    public function setProductSize(?int $ProductSize): self
    {
        $this->ProductSize = $ProductSize;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getCart(): ?Order
    {
        return $this->cart;
    }

    public function setCart(?Order $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getSize(): ?Size
    {
        return $this->size;
    }

    public function setSize(?Size $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @param OrderDetail $details
     * @return bool
     */
    public function equals(self $details): bool
    {
        return $this->getProduct()->getProductID() === $details->getProduct()->getProductID()
            && $this->getSize()->getSizeID() === $details->getSize()->getSizeID();
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->getProduct()->getPrice() * $this->getQuantity();
    }
}
