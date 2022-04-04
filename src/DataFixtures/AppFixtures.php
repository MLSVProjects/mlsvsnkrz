<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Category;
use App\Entity\Brand;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {


        //USER
        $user = new User();
        $user->setEmail('administratorMLSV@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->hasher->hashPassword($user,'adminadmin'));
        $user->setName('Administrator');
        $user->setSurname('Administrator');
        $user->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('vincentMLSV@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->hasher->hashPassword($user,'vincentvincent'));
        $user->setName('Vincent');
        $user->setSurname('Nguyen');
        $user->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('merwane.zioui@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->hasher->hashPassword($user,'merwanemerwane'));
        $user->setName('Merwane');
        $user->setSurname('Zioui');
        $user->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('sofianeMLSV@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->hasher->hashPassword($user,'sofianesofiane'));
        $user->setName('Sofiane');
        $user->setSurname('Djemaa');
        $user->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('leonMLSV@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->hasher->hashPassword($user,'leonleon'));
        $user->setName('Leon');
        $user->setSurname('Van Linden');
        $user->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($user);
        $manager->flush();

        //BRAND
        $brand1 = new Brand();
        $brand1->setName('nike');
        $manager->persist($brand1);
        $manager->flush();


        $brand2 = new Brand();
        $brand2->setName('adidas');
        $manager->persist($brand2);
        $manager->flush();

        $brand3 = new Brand();
        $brand3->setName('Converse');
        $manager->persist($brand3);
        $manager->flush();


        //CATEGORY
        $category1 = new Category();
        $category1->setName('Men');
        $manager->persist($category1);
        $manager->flush();

        $category2 = new Category();
        $category2->setName('Women');
        $manager->persist($category2);
        $manager->flush();

        $category3 = new Category();
        $category3->setName('Unisex');
        $manager->persist($category3);
        $manager->flush();

        //PRODUCT
        $Product = new Product();
        $Product->setCategory($category3);
        $Product->setBrand($brand1);
        $Product->setName('Air Jordan 1 Mid Chicago');
        $Product->setPrice('275');
        $Product->setCreatedAt(new \DateTimeImmutable());
        $Product->setImage('Paire1.png');
        $manager->persist($Product);
        $manager->flush();

        $Product = new Product();
        $Product->setCategory($category3);
        $Product->setBrand($brand1);
        $Product->setName('Air Jordan 4 Union');
        $Product->setPrice('1000');
        $Product->setCreatedAt(new \DateTimeImmutable());
        $Product->setImage('Paire2.png');
        $manager->persist($Product);
        $manager->flush();

        $Product = new Product();
        $Product->setCategory($category3);
        $Product->setBrand($brand1);
        $Product->setName('Air Jordan 4 Retro Union');
        $Product->setPrice('1000');
        $Product->setCreatedAt(new \DateTimeImmutable());
        $Product->setImage('Paire3.png');
        $manager->persist($Product);
        $manager->flush();

        $Product = new Product();
        $Product->setCategory($category3);
        $Product->setBrand($brand2);
        $Product->setName('Yeezy 700 Wave Runner');
        $Product->setPrice('355');
        $Product->setCreatedAt(new \DateTimeImmutable());
        $Product->setImage('Paire4.png');
        $manager->persist($Product);
        $manager->flush();

        $Product = new Product();
        $Product->setCategory($category3);
        $Product->setBrand($brand1);
        $Product->setName('Air Max 1 Patta Waves Monarch');
        $Product->setPrice('320');
        $Product->setCreatedAt(new \DateTimeImmutable());
        $Product->setImage('Paire5.png');
        $manager->persist($Product);
        $manager->flush();

        $Product = new Product();
        $Product->setCategory($category3);
        $Product->setBrand($brand3);
        $Product->setName('Converse the Ten Nike x Off white');
        $Product->setPrice('1359');
        $Product->setCreatedAt(new \DateTimeImmutable());
        $Product->setImage('Paire6.png');
        $manager->persist($Product);
        $manager->flush();

    }
}
