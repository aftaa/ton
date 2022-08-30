<?php

namespace App\Entity;

use App\Repository\LikeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeRepository::class)]
#[ORM\Table(name: '`like`')]
class Like
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    private ?Product $relation = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $score = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRelation(): ?Product
    {
        return $this->relation;
    }

    public function setRelation(?Product $relation): self
    {
        $this->relation = $relation;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

        return $this;
    }
}
