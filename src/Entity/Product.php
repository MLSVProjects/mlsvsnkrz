<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

	#[ORM\Column(type: 'datetime_immutable', nullable: true)]
                   private $updated_at;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $deleted_at;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\ManyToOne(targetEntity: Brand::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $brand;

	#[ORM\Column(type: 'decimal', precision: 16, scale: 2)]
                   private $price;

    #[ORM\OneToMany(mappedBy: 'product_id', targetEntity: ProductDetail::class, orphanRemoval: true)]
    private $productDetails;

    #[ORM\OneToMany(mappedBy: 'product_id', targetEntity: PriceHistory::class, orphanRemoval: true)]
    private $priceHistories;

    public function __construct()
    {
        $this->productDetails = new ArrayCollection();
        $this->priceHistories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

	public function getUpdatedAt(): ?\DateTimeImmutable
                   {
                       return $this->updated_at;
                   }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deleted_at;
    }

    public function setDeletedAt(?\DateTimeImmutable $deleted_at): self
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

	public function getPrice(): ?string
                   {
                       return $this->price;
                   }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, ProductDetail>
     */
    public function getProductDetails(): Collection
    {
        return $this->productDetails;
    }

    public function addProductDetail(ProductDetail $productDetail): self
    {
        if (!$this->productDetails->contains($productDetail)) {
            $this->productDetails[] = $productDetail;
            $productDetail->setProductId($this);
        }

        return $this;
    }

    public function removeProductDetail(ProductDetail $productDetail): self
    {
        if ($this->productDetails->removeElement($productDetail)) {
            // set the owning side to null (unless already changed)
            if ($productDetail->getProductId() === $this) {
                $productDetail->setProductId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PriceHistory>
     */
    public function getPriceHistories(): Collection
    {
        return $this->priceHistories;
    }

    public function addPriceHistory(PriceHistory $priceHistory): self
    {
        if (!$this->priceHistories->contains($priceHistory)) {
            $this->priceHistories[] = $priceHistory;
            $priceHistory->setProductId($this);
        }

        return $this;
    }

    public function removePriceHistory(PriceHistory $priceHistory): self
    {
        if ($this->priceHistories->removeElement($priceHistory)) {
            // set the owning side to null (unless already changed)
            if ($priceHistory->getProductId() === $this) {
                $priceHistory->setProductId(null);
            }
        }

        return $this;
    }
}
