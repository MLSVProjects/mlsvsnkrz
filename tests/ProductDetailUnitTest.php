<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Product;
use App\Entity\ProductDetail;

class ProductDetailUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $productDetail = new ProductDetail();
        $product = new Product();

        $productDetail->setProductId($product);
        $productDetail->setSize('6.5');

        $this->assertTrue($productDetail->getProductId() === $product);
        $this->assertTrue($productDetail->getSize() === '6.5');


    }

    public function testIsFalse()
    {
        $productDetail = new ProductDetail();
        $product = new Product();
        $product1 = new Product();

        $productDetail->setProductId($product);
        $productDetail->setSize('6.5');

        $this->assertFalse($productDetail->getProductId() === $product1);
        $this->assertFalse($productDetail->getSize() === '7.5');
    }

    public function testIsEmpty()
    {
        $productDetail = new ProductDetail();
        $this->assertEmpty($productDetail->getId());
        $this->assertEmpty($productDetail->getProductId());
        $this->assertEmpty($productDetail->getSize());
    }
}