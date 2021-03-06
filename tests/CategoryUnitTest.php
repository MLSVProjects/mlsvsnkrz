<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Category;
use App\Entity\Product;

class CategoryUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $category = new Category();
        $category->setName('Men');
        $this->assertTrue($category->getName() === 'Men');
        $this->assertTrue($category->__toString() === $category->getName());
    }

    public function testIsFalse()
    {
        $category = new Category();
        $category->setName('Men');
        $this->assertFalse($category->getName() === 'Unisex');
    }

    public function testIsEmpty()
    {
        $category = new Category();
        $this->assertEmpty($category->getId());
        $this->assertEmpty($category->getName());
        $this->assertEmpty($category->getProducts());
    }

    public function testAddGetRemoveProduct()
    {
        $category = new Category();
        $product = new Product();

        $category->addProduct($product);
        $this->assertContains($product, $category->getProducts());
        $category->removeProduct($product);
        $this->assertEmpty($category->getProducts());
    }
}