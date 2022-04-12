<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Brand;
use App\Entity\Product;

class BrandUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $brand = new Brand();
        $brand->setName('Nike');
        $this->assertTrue($brand->getName() === 'Nike');
        $this->assertTrue($brand->__toString() === $brand->getName());
    }

    public function testIsFalse()
    {
        $brand = new Brand();
        $brand->setName('Nike');
        $this->assertFalse($brand->getName() === 'Adidas');
    }

    public function testIsEmpty()
    {
        $brand = new Brand();
        $this->assertEmpty($brand->getId());
        $this->assertEmpty($brand->getName());
        $this->assertEmpty($brand->getProducts());
    }

    public function testAddGetRemoveProduct()
    {
        $brand = new Brand();
        $product = new Product();

        $brand->addProduct($product);
        $this->assertContains($product, $brand->getProducts());
        $brand->removeProduct($product);
        $this->assertEmpty($brand->getProducts());
    }
}