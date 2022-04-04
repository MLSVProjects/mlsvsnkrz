<?php

namespace App\EventSubscriber;

use App\Entity\Product;
use App\Entity\PriceHistory;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\Alert;

class EasyAdminSubscriber implements EventSubscriberInterface
{
	private $doctrine;
	private $em;
	private $mailer;

    public function __construct(MailerInterface $mailer, ManagerRegistry $doctrine, EntityManagerInterface $em)
    {
		$this->mailer = $mailer;
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
		$this->informUsers($priceHistory);
	}

	public function prePersist(LifecycleEventArgs $args)
	{
		$entity = $args->getObject();

        if (!($entity instanceof Product)) {
            return;
        }
		$entity->setImage('image/'.$entity->getImage());
	}

	public function informUsers($priceHistory)
	{
		$alerts = $this->doctrine->getRepository(Alert::class)->findAllGreaterThanPrice($priceHistory);

		foreach($alerts as $alert) {
			$user = $alert->getUser();
			$email = (new Email())
                ->from('jevoletoutesvosdonnes@gmail.com')
                ->to($user->getEmail())
                ->subject('Alert : a product has reached your goal !')
                ->text($priceHistory->getProductId()->getName())
                ->html('<p>'.$priceHistory->getProductId()->getName().'</p>');

            $this->mailer->send($email);
		}
	}
}