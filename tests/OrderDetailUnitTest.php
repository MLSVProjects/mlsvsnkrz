<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\OrderDetail;
use App\Entity\Order;
use App\Entity\Product;

class OrderDetailUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $orderDetail = new OrderDetail();
        $order = new Order();
        $product = new Product();

        $orderDetail->setOrderId($order);
        $orderDetail->setProductId($product);
        $orderDetail->setSize('5.5');
        $orderDetail->setQuantity(100);
        $orderDetail->setPrice('1500');

         $this->assertTrue($orderDetail->getOrderId() === $order);
         $this->assertTrue($orderDetail->getProductId() === $product);
         $this->assertTrue($orderDetail->getSize() === '5.5');
         $this->assertTrue($orderDetail->getQuantity() === 100);
         $this->assertTrue($orderDetail->getPrice() === '1500');


    }

    public function testIsFalse()
    {
        $orderDetail = new OrderDetail();
        $order = new Order();
        $order1 = new Order();
        $product = new Product();
        $product1 = new Product();

        $orderDetail->setOrderId($order);
        $orderDetail->setProductId($product);
        $orderDetail->setSize('5.5');
        $orderDetail->setQuantity(100);
        $orderDetail->setPrice('1500');

         $this->assertFalse($orderDetail->getOrderId() === $order1);
         $this->assertFalse($orderDetail->getProductId() === $product1);
         $this->assertFalse($orderDetail->getSize() === '6.5');
         $this->assertFalse($orderDetail->getQuantity() === 150);
         $this->assertFalse($orderDetail->getPrice() === '1550');

    }

    public function testIsEmpty()
    {
        $orderDetail = new OrderDetail();
        $this->assertEmpty($orderDetail->getId());
        $this->assertEmpty($orderDetail->getOrderId());
        $this->assertEmpty($orderDetail->getProductId());
        $this->assertEmpty($orderDetail->getSize());
        $this->assertEmpty($orderDetail->getQuantity());
        $this->assertEmpty($orderDetail->getPrice());
    }
}
