<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private $id;

  #[ORM\Column(type: 'string', length: 255)]
  private $title;

  #[ORM\Column(type: 'text')]
  private $content;

  #[ORM\Column(type: 'string', length: 255)]
  private $image;

  #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'])]
  private $createdAt;

  #[ORM\ManyToMany(targetEntity: Categories::class, inversedBy: 'articles')]
  private $category;

  #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'articles')]
  #[ORM\JoinColumn(nullable: false)]
  private $user;

  public function __construct()
  {
    $this->category = new ArrayCollection();
    $this->createdAt = new \DateTimeImmutable();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getTitle(): ?string
  {
    return $this->title;
  }

  public function setTitle(string $title): self
  {
    $this->title = $title;

    return $this;
  }

  public function getContent(): ?string
  {
    return $this->content;
  }

  public function setContent(string $content): self
  {
    $this->content = $content;

    return $this;
  }

  public function getImage(): ?string
  {
    return $this->image;
  }

  public function setImage(string $image): self
  {
    $this->image = $image;

    return $this;
  }

  public function getCreatedAt(): ?\DateTimeImmutable
  {
    return $this->createdAt;
  }

  public function setCreatedAt(\DateTimeImmutable $createdAt): self
  {
    $this->createdAt = $createdAt;

    return $this;
  }

  /**
   * @return Collection<int, Categories>
   */
  public function getCategory(): Collection
  {
    return $this->category;
  }

  public function addCategory(Categories $category): self
  {
    if (!$this->category->contains($category)) {
      $this->category[] = $category;
    }

    return $this;
  }

  public function removeCategory(Categories $category): self
  {
    $this->category->removeElement($category);

    return $this;
  }

  public function getUser(): ?Users
  {
    return $this->user;
  }

  public function setUser(?Users $user): self
  {
    $this->user = $user;

    return $this;
  }
}
