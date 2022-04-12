<?php

namespace App\Tests;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Entity\Bookmark;
use App\Entity\Order;
use App\Entity\Alert;


class UserUnitTest extends TestCase
{
    public function testIsTrue()
    {
       $user = new User();
       $datetime = new DateTimeImmutable();

        $user->setEmail('testtrue@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword('testtest');
        $user->setName('test');
        $user->setSurname('test');
        $user->setCity('Paris');
        $user->setAddress('Rue Tolbiac');
        $user->setZip('75000');
        $user->setCountry('France');
        $user->setCreatedAt($datetime);
        $user->setUpdatedAt($datetime);
        $user->setDeletedAt($datetime);

    $this->assertTrue($user->__toString() === $user->getEmail());
    $this->assertTrue($user->getEmail() === 'testtrue@gmail.com');
    $this->assertTrue($user->getRoles() === ['ROLE_USER']);
    $this->assertTrue($user->getPassword() === 'testtest');
    $this->assertTrue($user->getName() === 'test');
    $this->assertTrue($user->getSurname() === 'test');
    $this->assertTrue($user->getCity() === 'Paris');
    $this->assertTrue($user->getAddress() === 'Rue Tolbiac');
    $this->assertTrue($user->getZip() === '75000');
    $this->assertTrue($user->getCountry() === 'France');
    $this->assertTrue($user->getCreatedAt() === $datetime);
    $this->assertTrue($user->getUpdatedAt() === $datetime);
    $this->assertTrue($user->getDeletedAt() === $datetime);
    }

    public function testIsFalse()
    {

        $user = new User();
       $datetime = new DateTimeImmutable();

        $user->setEmail('testtrue@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword('testtest');
        $user->setName('test');
        $user->setSurname('test');
        $user->setCity('Paris');
        $user->setAddress('Rue Tolbiac');
        $user->setZip('75000');
        $user->setCountry('France');
        $user->setCreatedAt($datetime);
        $user->setUpdatedAt($datetime);
        $user->setDeletedAt($datetime);


    $this->assertFalse($user->getEmail() === 'testfalse@gmail.com');
    $this->assertFalse($user->getRoles() === ['ROLE_ADMIN']);
    $this->assertFalse($user->getPassword() === 'testtest1');
    $this->assertFalse($user->getName() === 'test1');
    $this->assertFalse($user->getSurname() === 'test1');
    $this->assertFalse($user->getAddress() === 'Rue Baudricourt');
    $this->assertFalse($user->getCity() === 'Paris 1');
    $this->assertFalse($user->getZip() === '75001');
    $this->assertFalse($user->getCountry() === 'Algérie');
    $this->assertFalse($user->getCreatedAt() === '1985-3-3');
    $this->assertFalse($user->getUpdatedAt() === '1988-5-31');
    $this->assertFalse($user->getDeletedAt() === '1995-1-30');
    }

    public function testIsEmpty()
    {
        $user = new User();
        $this->assertEmpty($user->getId());
        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getUserIdentifier());
        $this->assertNotEmpty($user->getRoles());
        $this->assertEmpty($user->eraseCredentials());
        $this->assertEmpty($user->getName());
        $this->assertEmpty($user->getSurname());
        $this->assertEmpty($user->getCity());
        $this->assertEmpty($user->getZip());
        $this->assertEmpty($user->getCountry());
        $this->assertEmpty($user->getCreatedAt());
        $this->assertEmpty($user->getUpdatedAt());
        $this->assertEmpty($user->getDeletedAt());
        $this->assertEmpty($user->getAddress());
        $this->assertEmpty($user->getBookmarks());
        $this->assertEmpty($user->getOrders());
        $this->assertEmpty($user->getAlerts());
    }

    public function testAddGetRemoveBookmark()
    {
        $user = new User();
        $bookmark = new Bookmark();

        $user->addBookmark($bookmark);
        $this->assertContains($bookmark, $user->getBookmarks());
        $user->removeBookmark($bookmark);
        $this->assertEmpty($user->getBookmarks());
    }

    public function testAddGetRemoveOrder()
    {
        $user = new User();
        $order = new Order();

        $user->addOrder($order);
        $this->assertContains($order, $user->getOrders());
        $user->removeOrder($order);
        $this->assertEmpty($user->getOrders());
    }

    public function testAddGetRemoveAlert()
    {
        $user = new User();
        $alert = new Alert();

        $user->addAlert($alert);
        $this->assertContains($alert, $user->getAlerts());
        $user->removeAlert($alert);
        $this->assertEmpty($user->getAlerts());
    }
}