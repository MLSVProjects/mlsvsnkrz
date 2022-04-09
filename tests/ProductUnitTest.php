<?php

namespace App\Tests;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use App\Entity\Product;
use App\Entity\Brand;
use App\Entity\Category;

class ProductUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $product = new Product();
        $brand = new Brand();
        $category = new Category();
        $date = new DateTimeImmutable();

        $product->setCategory($category);
        $product->setBrand($brand);
        $product->setName('Air Jordan 1 Mid Chicago');
        $product->setPrice('275');
        $product->setCreatedAt($date);
        $product->setUpdatedAt($date);
        $product->setDeletedAt($date);
        $product->setImage('Paire1.png');

        $this->assertTrue($product->getCategory() === $category);
        $this->assertTrue($product->getBrand() === $brand);
        $this->assertTrue($product->getName() === 'Air Jordan 1 Mid Chicago');
        $this->assertTrue($product->getPrice() === '275');
        $this->assertTrue($product->getCreatedAt() === $date);
        $this->assertTrue($product->getUpdatedAt() === $date);
        $this->assertTrue($product->getDeletedAt() === $date);
        $this->assertTrue($product->getImage() === 'Paire1.png');
    }

    public function testIsFalse()
    {
        $product = new Product();

        $brand = new Brand();
        $brand1 = new Brand();

        $category = new Category();
        $category1 = new Category();

        $date = new DateTimeImmutable();
        $date1 = new DateTimeImmutable();

        $product->setCategory($category);
        $product->setBrand($brand);
        $product->setName('Air Jordan 1 Mid Chicago');
        $product->setPrice('275');
        $product->setCreatedAt($date);
        $product->setUpdatedAt($date);
        $product->setDeletedAt($date);
        $product->setImage('Paire1.png');

        $this->assertFalse($product->getCategory() === $category1);
        $this->assertFalse($product->getBrand() === $brand1);
        $this->assertFalse($product->getName() === 'Air Jordan 2 Mid Chicago');
        $this->assertFalse($product->getPrice() === '285');
        $this->assertFalse($product->getCreatedAt() === $date1);
        $this->assertFalse($product->getUpdatedAt() === $date1);
        $this->assertFalse($product->getDeletedAt() === $date1);
        $this->assertFalse($product->getImage() === 'Paire2.png');
    }

    public function testIsEmpty()
    {
        $product = new Product();
        $this->assertEmpty($product->getId());
        $this->assertEmpty($product->getName());
        $this->assertEmpty($product->getImage());
        $this->assertNotEmpty($product->getCreatedAt());
        $this->assertEmpty($product->getUpdatedAt());
        $this->assertEmpty($product->getDeletedAt());
        $this->assertEmpty($product->getCategory());
        $this->assertEmpty($product->getBrand());
        $this->assertEmpty($product->getPrice());
        $this->assertEmpty($product->getProductDetails());
        $this->assertEmpty($product->getPriceHistories());
    }
}