<?php

namespace App\Controller\User;

use Doctrine\ORM\EntityManagerInterface;
use App\Form\RegistrationFormType;
use App\Repository\AlertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Repository\BookmarkRepository;

class ProfilePageController extends AbstractController
{
    /**
     * @Route("/profile/", name="profile")
     */
    public function home () : Response
    {
        return $this->render('profile/profile.html.twig');
    }

	/**
     * @Route("/profile/alerts/", name="alerts")
     */
    public function alerts(AlertRepository $alertRepository) : Response
    {
        return $this->render('profile/alerts.html.twig', [
			"alerts" => $alertRepository->findBy([
				"user" => $this->getUser()
			])
		]);
    }

    /**
     * @Route("/profile/bookmarks/", name="bookmarks")
     */
    public function bookmarks(BookMarkRepository $bookMarkRepository) : Response
    {
        return $this->render('profile/bookmarks.html.twig',[
			"bookmarks"=>$bookMarkRepository->findBy(['user_id'=>$this->getUser()])
		]);
    }

    /**
     * @Route("/profile/edit/", name="edit_profile", methods={"POST"})
     */
    public function edit (UserRepository $userRepository, Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager ) : Response
    {
        $id= $_GET["idUser"];
        $user= $userRepository->find($id);
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('profil_page');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);


    }

}