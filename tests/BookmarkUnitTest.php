<?php

namespace App\Tests;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use App\Entity\Bookmark;
use App\Entity\User;
use App\Entity\Product;

class BookmarkUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $bookmark = new Bookmark();
        $user = new User();
        $product = new Product();
        $datetime = new DateTimeImmutable();

        $bookmark->setUserId($user);
        $bookmark->setProductId($product);
        $bookmark->setAddedAt($datetime);
        $bookmark->setDeletedAt($datetime);

        $this->assertTrue($bookmark->getUserId() === $user);
        $this->assertTrue($bookmark->getProductId() === $product);
        $this->assertTrue($bookmark->getAddedAt() === $datetime);
        $this->assertTrue($bookmark->getDeletedAt() === $datetime);

    }

    public function testIsFalse()
    {
        $bookmark = new Bookmark();
        $user = new User();
        $user1 = new User();
        $product = new Product();
        $product1 = new Product();
        $datetime = new DateTimeImmutable();
        $datetime1 = new DateTimeImmutable();

        $bookmark->setUserId($user);
        $bookmark->setProductId($product);
        $bookmark->setAddedAt($datetime);
        $bookmark->setDeletedAt($datetime);

        $this->assertFalse($bookmark->getUserId() === $user1);
        $this->assertFalse($bookmark->getProductId() === $product1);
        $this->assertFalse($bookmark->getAddedAt() === $datetime1);
        $this->assertFalse($bookmark->getDeletedAt() === $datetime1);
    }

    public function testIsEmpty()
    {
        $bookmark = new Bookmark();
        $this->assertEmpty($bookmark->getId());
        $this->assertEmpty($bookmark->getUserId());
        $this->assertEmpty($bookmark->getProductId());
        $this->assertEmpty($bookmark->getAddedAt());
        $this->assertEmpty($bookmark->getDeletedAt());
    }
}