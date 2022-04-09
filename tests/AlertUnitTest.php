<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Alert;
use App\Entity\User;
use App\Entity\Product;

class AlertUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $alert = new Alert();
        $user = new User();
        $product = new Product();

        $alert->setUser($user);
        $alert->setProduct($product);
        $alert->setPrice('450');

        $this->assertTrue($alert->getUser() === $user);
        $this->assertTrue($alert->getProduct() === $product);
        $this->assertTrue($alert->getPrice() === '450');

    }

    public function testIsFalse()
    {
        $alert = new Alert();
        $user = new User();
        $user1 = new User();
        $product = new Product();
        $product1 = new Product();

        $alert->setUser($user);
        $alert->setProduct($product);
        $alert->setPrice('450');

        $this->assertFalse($alert->getUser() === $user1);
        $this->assertFalse($alert->getProduct() === $product1);
        $this->assertFalse($alert->getPrice() === '650');

    }

    public function testSomething()
    {
        $alert = new Alert();
        $this->assertEmpty($alert->getId());
        $this->assertEmpty($alert->getUser());
        $this->assertEmpty($alert->getProduct());
        $this->assertEmpty($alert->getPrice());

    }
}