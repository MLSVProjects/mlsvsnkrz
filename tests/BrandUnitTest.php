<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Brand;

class BrandUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $brand = new Brand();
        $brand->setName('Nike');
        $this->assertTrue($brand->getName() === 'Nike');
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
}
