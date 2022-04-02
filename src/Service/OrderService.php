<?php

namespace App\Service;

use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Repository\ProductRepository;
use Stripe\Checkout\Session;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

class OrderService
{
	private $security;
	private $doctrine;
	private $productRepository;

	public function __construct(Security $security, ManagerRegistry $doctrine, ProductRepository $productRepository)
	{
		$this->security = $security;
		$this->doctrine = $doctrine;
		$this->productRepository = $productRepository;
	}

	public function createOrder($cart, Session $session)
	{
		$entityManager = $this->doctrine->getManager();

		$uid = $this->security->getUser();

		$address = $session->shipping->address;

		$totalPrice = $session->amount_total/100.00;

		$shippingPrice = $session->total_details->amount_shipping/100.00;

		$order = new Order();
		$order->setUserId($uid)
		->setPrice($totalPrice)
		->setShippingAddress($address->line1.", ".$address->postal_code. ", ".$address->city. ", ".$address->country)
		->setCreatedAt(new \DateTimeImmutable())
		->setShippingPrice($shippingPrice)
		->setStatus('PAID');

		$entityManager->persist($order);
		$entityManager->flush();

		foreach($cart as $product) {
			$productEntity = $this->productRepository->find($product['product_id']);
			$orderDetail = new OrderDetail();
			$orderDetail->setOrderId($order)
			->setProductId($productEntity)
			->setSize(44)
			->setQuantity($product['quantity'])
			->setPrice($productEntity->getPrice());
			$entityManager->persist($orderDetail);
			$entityManager->flush();
		}
	}
}