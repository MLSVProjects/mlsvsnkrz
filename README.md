# mlsvsnkrz - E-commerce Website

> Created by Merwane Zioui, Vincent Nguyen, Sofiane Djemaa, Leon Van Linden, as part of a school project

## Langages Used
### Backend

#### PHP/Symfony

> https://symfony.com/

To provide a backend structure to our web application, we are using PHP with the Symfony framework.
Symfony is a well-known PHP framework to create web apps. It helps having a MVC architecture for a project.

#### Stripe

> https://stripe.com

Stripe is an API providing a payment system. It is used in the app to process payment after checkout.
It is a test version, to test it :
1. Enter your delivery address
2. Enter your card number (use 4242 4242 4242 4242 for a successful payment)

### Database - Doctrine

> https://www.doctrine-project.org/projects/orm.html

Doctrine is a PHP ORM (Object Relational Mapper). It helps use creating a database form objects, then used in our app (products, bookmarks, ...)

### Frontend
#### Twig

> https://twig.symfony.com/

Twig is used by Symfony on the frontend to create HTML templates. Also, it helps dynamically creating pages, depending on the content.
It is also useful when wanting to display PHP and database's objects directly from a Controller.

#### Bulma

> https://bulma.io/

Bulma is a CSS library. As an alternative to Bootstrap, it helps creating a pleasing UI quickly, by providing minimalist yet effective HTML elements.

### Package management
#### Composer

> https://getcomposer.org/

Composer is a PHP package manager used by Symfony. It helps us installing new packages to develop the Symfony backend.

#### Yarn/NPM

> https://www.npmjs.com/

NPM is a Javascript package manager. As Composer, it helps providing packages for the frontend application, such as CSS libraries.

## Class diagram

![Class Diagram](https://github.com/MLSVProjects/mlsvsnkrz/blob/develop/ClassDiagram.png)

## Setup steps

1. Download PHP, Symfony, Composer and NPM :
- https://symfony.com/download
- https://www.php.net/downloads.php
- https://getcomposer.org/download/
- https://docs.npmjs.com/downloading-and-installing-node-js-and-npm
2. Clone the repository on your local machine.
3. In the .env file, line 34, change "db_user", "db_password" and "db_name" with a currently existing user.
4. Go to the project directory. In your terminal, run the following commands :
```console
composer update
npm install
symfony console doctrine:migrations:migrate
symfony console doctrine:fixtures:load
npm run build
symfony server:start
```
### Users

- Admin : administratorMLSV@gmail.com adminadmin
- User : merwane.zioui@gmail.com merwanemerwane
