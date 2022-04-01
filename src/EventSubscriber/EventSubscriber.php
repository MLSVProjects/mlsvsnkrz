<?php

namespace App\EventSubscriber;

use App\Entity\Product;
use App\Entity\PriceHistory;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs as EventLifecycleEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Persistence\ManagerRegistry;

class EasyAdminSubscriber implements EventSubscriberInterface
{
	private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
			Events::postUpdate,
			Events::prePersist
        ];
    }

	public function postPersist(LifecycleEventArgs $args)
	{
		$entity = $args->getObject();

        if (!($entity instanceof Product)) {
            return;
        }
		$manager = $this->doctrine->getManager();
		$priceHistory = new PriceHistory();
		$priceHistory->setProductId($entity)
			->setPrice($entity->getPrice())
			->setDate(new \DateTimeImmutable());
		$manager->persist($priceHistory);
		$manager->flush();
	}

	public function postUpdate(LifecycleEventArgs $args)
	{
		$entity = $args->getObject();

        if (!($entity instanceof Product)) {
            return;
        }
		$entity->setUpdatedAt(new \DateTimeImmutable());
		$manager = $this->doctrine->getManager();
		$priceHistory = new PriceHistory();
		$priceHistory->setProductId($entity)
			->setPrice($entity->getPrice())
			->setDate(new \DateTimeImmutable());
		$manager->persist($priceHistory);
		$manager->flush();
	}

	public function prePersist(LifecycleEventArgs $args)
	{
		$entity = $args->getObject();

        if (!($entity instanceof Product)) {
            return;
        }
		$entity->setImage('image/'.$entity->getImage());
	}
}