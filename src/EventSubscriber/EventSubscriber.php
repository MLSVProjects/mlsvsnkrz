<?php

namespace App\EventSubscriber;

use App\Entity\Product;
use App\Entity\PriceHistory;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs as EventLifecycleEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
	private $doctrine;
	private $em;

    public function __construct(ManagerRegistry $doctrine, EntityManagerInterface $em)
    {
        $this->doctrine = $doctrine;
		$this->em = $em;
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

		$uow = $this->em->getUnitOfWork();
		$uow->computeChangeSets(); // do not compute changes if inside a listener
		$changeset = $uow->getEntityChangeSet($entity);

        if (!($entity instanceof Product)) {
            return;
        }
		if(array_key_exists('deleted_at', $changeset) && $changeset['deleted_at'][1]!=null) {
			return;
		}
		if(array_key_exists('updated_at', $changeset)) {
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