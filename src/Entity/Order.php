<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: 'TripOrders')]
class Order
{
    public const STATUSES = [
        'Принят',
        'В процессе',
        'Готов',
        'Оплачен',
        'Выполнен',
    ];

    public const STATUSES_EN = [
        'Accepted',
        'In process',
        'Ready',
        'Paid',
        'Done',
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'OrderID', type: 'integer')]
    private $OrderID;

    #[ORM\Column(name: 'CustomerID', type: 'integer')]
    private $CustomerID;

    #[ORM\Column(name: 'OrderStatus', type: 'integer')]
    private $OrderStatus;

    #[ORM\Column(name: 'OrderDate', type: 'datetime')]
    private $OrderDate;

    #[ORM\Column(name: 'TotalPrice', type: 'integer')]
    private $TotalPrice;

    #[ORM\Column(name: 'TotalQuantity', type: 'integer')]
    private $TotalQuantity;

    #[ORM\Column(name: 'ShipCountry', type: 'string', length: 255)]
    private $ShipCountry;

    #[ORM\Column(name: 'ShipCity', type: 'string', length: 255)]
    private $ShipCity;

    #[ORM\Column(name: 'ShipPostalcode', type: 'string', length: 6)]
    private $ShipPostalcode;

    #[ORM\Column(name: 'ShipAddress', type: 'text')]
    private $ShipAddress;

    #[ORM\Column(name: 'ShipDate', type: 'date')]
    private $ShipDate;

    #[ORM\Column(type: 'text')]
    private $Comments;

    #[ORM\Column(type: 'string', length: 10)]
    private $Currency;

    #[ORM\Column(name: 'ShipMetro', type: 'string', length: 100)]
    private $ShipMetro;

    #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(name: 'CustomerID', referencedColumnName: 'CustomerID', nullable: false)]
    private $customer;

    #[ORM\OneToMany(mappedBy: 'cart', targetEntity: OrderDetail::class)]
    private $details;

    public function __construct()
    {
        $this->details = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCustomerID(): ?int
    {
        return $this->CustomerID;
    }

    public function setCustomerID(int $CustomerID): self
    {
        $this->CustomerID = $CustomerID;

        return $this;
    }

    public function getOrderStatus(): ?int
    {
        return $this->OrderStatus;
    }

    public function setOrderStatus(int $OrderStatus): self
    {
        $this->OrderStatus = $OrderStatus;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->OrderDate;
    }

    public function setOrderDate(\DateTimeInterface $OrderDate): self
    {
        $this->OrderDate = $OrderDate;

        return $this;
    }

    public function getTotalPrice(): ?int
    {
        return $this->TotalPrice;
    }

    public function setTotalPrice(int $TotalPrice): self
    {
        $this->TotalPrice = $TotalPrice;

        return $this;
    }

    public function getTotalQuantity(): ?int
    {
        return $this->TotalQuantity;
    }

    public function setTotalQuantity(int $TotalQuantity): self
    {
        $this->TotalQuantity = $TotalQuantity;

        return $this;
    }

    public function getShipCountry(): ?string
    {
        return $this->ShipCountry;
    }

    public function setShipCountry(string $ShipCountry): self
    {
        $this->ShipCountry = $ShipCountry;

        return $this;
    }

    public function getShipCity(): ?string
    {
        return $this->ShipCity;
    }

    public function setShipCity(string $ShipCity): self
    {
        $this->ShipCity = $ShipCity;

        return $this;
    }

    public function getShipPostalcode(): ?string
    {
        return $this->ShipPostalcode;
    }

    public function setShipPostalcode(string $ShipPostalcode): self
    {
        $this->ShipPostalcode = $ShipPostalcode;

        return $this;
    }

    public function getShipAddress(): ?string
    {
        return $this->ShipAddress;
    }

    public function setShipAddress(string $ShipAddress): self
    {
        $this->ShipAddress = $ShipAddress;

        return $this;
    }

    public function getShipDate(): ?\DateTimeInterface
    {
        return $this->ShipDate;
    }

    public function setShipDate(\DateTimeInterface $ShipDate): self
    {
        $this->ShipDate = $ShipDate;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->Comments;
    }

    public function setComments(string $Comments): self
    {
        $this->Comments = $Comments;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->Currency;
    }

    public function setCurrency(string $Currency): self
    {
        $this->Currency = $Currency;

        return $this;
    }

    public function getShipMetro(): ?string
    {
        return $this->ShipMetro;
    }

    public function setShipMetro(string $ShipMetro): self
    {
        $this->ShipMetro = $ShipMetro;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection<int, OrderDetail>
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(OrderDetail $detail): self
    {
        if (!$this->details->contains($detail)) {
            $this->details[] = $detail;
            $detail->setCart($this);
        }

        return $this;
    }

    public function removeDetail(OrderDetail $detail): self
    {
        if ($this->details->removeElement($detail)) {
            // set the owning side to null (unless already changed)
            if ($detail->getCart() === $this) {
                $detail->setCart(null);
            }
        }

        return $this;
    }
}
