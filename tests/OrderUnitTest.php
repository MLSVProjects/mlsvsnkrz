<?php

namespace App\Tests;

use DateTimeImmutable;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use PHPUnit\Framework\TestCase;
use App\Entity\Order;
use App\Entity\User;

class OrderUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $order = new Order();
        $datetime = new DateTimeImmutable();
        $user = new User;

        $order->setUserId($user);
        $order->setStatus('In preparation for');
        $order->setCreatedAt($datetime);
        $order->setUpdatedAt($datetime);
        $order->setDeletedAt($datetime);
        $order->setPrice('3800');
        $order->setShippingAddress('10 rue de l\'Angélus');
        $order->setShippingPrice('50');

        $this->assertTrue($order->getUserId() === $user);
        $this->assertTrue($order->getStatus() === 'In preparation for');
        $this->assertTrue($order->getCreatedAt() === $datetime);
        $this->assertTrue($order->getUpdatedAt() === $datetime);
        $this->assertTrue($order->getDeletedAt() === $datetime);
        $this->assertTrue($order->getPrice() === '3800');
        $this->assertTrue($order->getShippingAddress() === '10 rue de l\'Angélus');
        $this->assertTrue($order->getShippingPrice() === '50');
    }

    public function testIsFalse()
    {
        $order = new Order();
        $datetime = new DateTimeImmutable();
        $datetime1 = new DateTimeImmutable();
        $user = new User;
        $user1 = new User;

        $order->setUserId($user);
        $order->setStatus('In preparation for');
        $order->setCreatedAt($datetime);
        $order->setUpdatedAt($datetime);
        $order->setDeletedAt($datetime);
        $order->setPrice('3800');
        $order->setShippingAddress('10 rue de l\'Angélus');
        $order->setShippingPrice('50');

        $this->assertFalse($order->getUserId() === $user1);
        $this->assertFalse($order->getStatus() === 'Finish');
        $this->assertFalse($order->getCreatedAt() === $datetime1);
        $this->assertFalse($order->getUpdatedAt() === $datetime1);
        $this->assertFalse($order->getDeletedAt() === $datetime1);
        $this->assertFalse($order->getPrice() === '3801');
        $this->assertFalse($order->getShippingAddress() === '101 rue de l\'Angélus');
        $this->assertFalse($order->getShippingPrice() === '60');
    }

    public function testIsEmpty()
    {
        {
            $order = new Order();
            $this->assertEmpty($order->getId());
            $this->assertEmpty($order->getUserId());
            $this->assertEmpty($order->getStatus());
            $this->assertEmpty($order->getCreatedAt());
            $this->assertEmpty($order->getUpdatedAt());
            $this->assertEmpty($order->getDeletedAt());
            $this->assertEmpty($order->getPrice());
            $this->assertEmpty($order->getShippingAddress());
            $this->assertEmpty($order->getShippingPrice());
            $this->assertEmpty($order->getOrderDetails());
        }
    }
}