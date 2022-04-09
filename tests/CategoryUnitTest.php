<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Category;

class CategoryUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $category = new Category();
        $category->setName('Men');
        $this->assertTrue($category->getName() === 'Men');
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
}