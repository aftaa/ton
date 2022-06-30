<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[ORM\Table(name: 'TripCustomers')]
#[UniqueEntity(fields: ['Login'], message: 'There is already an account with this Login')]
class Customer implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'CustomerID', type: 'integer')]
    private $CustomerID;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private $Login;

//    #[ORM\Column(type: 'json')]
//    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $Pass;

    #[ORM\Column(name: 'FName', type: 'string', length: 255)]
    private $FName;

    #[ORM\Column(name: 'SName', type: 'string', length: 255)]
    private $SName;

    #[ORM\Column(name: 'LName', type: 'string', length: 255)]
    private $LName;

    #[ORM\Column(type: 'string', length: 255)]
    private $Email;

    #[ORM\Column(type: 'string', length: 255)]
    private $Phone;

    #[ORM\Column(type: 'string', length: 255)]
    private $Country;

    #[ORM\Column(type: 'string', length: 255)]
    private $City;

    #[ORM\Column(type: 'string', length: 255)]
    private $Postalcode;

    #[ORM\Column(type: 'string', length: 255)]
    private $Address;

    #[ORM\Column(type: 'string', length: 100)]
    private $Metro;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Order::class)]
    private $orders;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(type: 'json')]
    private array $roles;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getCustomerID()
    {
        return $this->CustomerID;
    }

    public function getId(): ?int
    {
        return $this->CustomerID;
    }

    public function getLogin(): ?string
    {
        return $this->Login;
    }

    public function setLogin(string $Login): self
    {
        $this->Login = $Login;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->Login;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->Pass;
    }

    public function setPassword(string $password): self
    {
        $this->Pass = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFName(): ?string
    {
        return $this->FName;
    }

    public function setFName(string $FName): self
    {
        $this->FName = $FName;

        return $this;
    }

    public function getSName(): ?string
    {
        return $this->SName;
    }

    public function setSName(string $SName): self
    {
        $this->SName = $SName;

        return $this;
    }

    public function getLName(): ?string
    {
        return $this->LName;
    }

    public function setLName(string $LName): self
    {
        $this->LName = $LName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getPostalcode(): ?string
    {
        return $this->Postalcode;
    }

    public function setPostalcode(string $Postalcode): self
    {
        $this->Postalcode = $Postalcode;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getMetro(): ?string
    {
        return $this->Metro;
    }

    public function setMetro(string $Metro): self
    {
        $this->Metro = $Metro;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setCustomer($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getCustomer() === $this) {
                $order->setCustomer(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
