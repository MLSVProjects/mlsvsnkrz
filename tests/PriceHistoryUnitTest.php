<?php

namespace App\Tests;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use App\Entity\Product;
use App\Entity\PriceHistory;

class PriceHistoryUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $priceHistory = new PriceHistory();
        $product = new Product();
        $datetime = new DateTimeImmutable();

        $priceHistory->setProductId($product);
        $priceHistory->setPrice('1500');
        $priceHistory->setDate($datetime);

        $this->assertTrue($priceHistory->getProductId() === $product);
        $this->assertTrue($priceHistory->getPrice() === '1500');
        $this->assertTrue($priceHistory->getDate() === $datetime);

    }

    public function testIsFalse()
    {
        $priceHistory = new PriceHistory();
        $product = new Product();
        $product1 = new Product();
        $datetime = new DateTimeImmutable();
        $datetime1 = new DateTimeImmutable();

        $priceHistory->setProductId($product1);
        $priceHistory->setPrice('1500');
        $priceHistory->setDate($datetime);

        $this->assertFalse($priceHistory->getProductId() === $product);
        $this->assertFalse($priceHistory->getPrice() === '2500');
        $this->assertFalse($priceHistory->getDate() === $datetime1);
    }

    public function testIsEmpty()
    {
        $priceHistory = new PriceHistory();
        $this->assertEmpty($priceHistory->getId());
        $this->assertEmpty($priceHistory->getProductId());
        $this->assertEmpty($priceHistory->getPrice());
        $this->assertEmpty($priceHistory->getDate());
    }
}
