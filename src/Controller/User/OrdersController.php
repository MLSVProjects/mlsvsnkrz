<?php

namespace App\Controller\User;

use App\Repository\OrderRepository;
use App\Repository\OrderDetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrdersController extends AbstractController
{
    /**
     * @Route("/profile/orders/", name="orders")
     */
    public function home(OrderRepository $orderRepository) : Response
    {
        return $this->render('profile/orders.html.twig', [
			"orders" => $orderRepository->findBy([
				"user_id" => $this->getUser()
			])
		]);
    }

	/**
     * @Route("profile/orders/{order_id}", name="orderDetail")
     */
    public function orderDetail($order_id, OrderRepository $orderRepository) : Response
    {
        return $this->render('profile/order_detail.html.twig', [
			"order" => $orderRepository->find($order_id)
		]);
    }

}